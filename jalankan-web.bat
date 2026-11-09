@echo off
title Web Sekolah SMP Al Ahmad Krian
color 0A

echo ========================================================
echo   MEMULAI SERVER WEB & DATABASE SMP AL AHMAD KRIAN
echo ========================================================
echo.

:: 1. Memeriksa apakah MySQL sudah aktif
echo [1/4] Memeriksa status database MySQL...
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo       [OK] Database MySQL sudah aktif.
) else (
    echo       [..] MySQL belum aktif. Menjalankan Laragon...
    start "" "C:\laragon\laragon.exe"
    echo       Silakan klik "Start All" di Laragon jika belum otomatis jalan.
    timeout /t 3 /nobreak >nul
)

:: 2. Masuk ke direktori project
cd /d "%~dp0"

:: 3. Mencari IP lokal Wi-Fi laptop untuk akses dari HP / perangkat lain
echo.
echo [2/4] Mendeteksi IP Address laptop...
set "MY_IP="
for /f "tokens=2 delims=:" %%a in ('ipconfig ^| findstr /c:"IPv4 Address"') do (
    if not defined MY_IP (
        set "MY_IP=%%a"
    )
)
if defined MY_IP (
    set "MY_IP=%MY_IP: =%"
    echo       [OK] IP Laptop terdeteksi: %MY_IP%
) else (
    echo       [..] IP tidak ditemukan, menggunakan localhost.
)

:: 4. Membersihkan proses PHP lama pada port 8000 jika ada yang tersangkut
echo.
echo [3/4] Memastikan port 8000 siap digunakan...
for /f "tokens=5" %%p in ('netstat -a -n -o ^| findstr ":8000.*LISTENING"') do (
    taskkill /F /PID %%p >nul 2>&1
)

:: 5. Buka browser otomatis ke localhost (aman dari error can't reach page)
echo.
echo [4/4] Membuka browser website...
timeout /t 2 /nobreak >nul
start http://localhost:8000

:: 6. Jalankan PHP Artisan Serve dengan host 0.0.0.0 agar bisa diakses semua perangkat
echo.
echo ========================================================
echo   SERVER BERHASIL DIAKTIFKAN!
echo ========================================================
echo   * Akses dari Laptop ini : http://localhost:8000
if defined MY_IP (
echo   * Akses dari HP / Teman : http://%MY_IP%:8000
)
echo   * Halaman Admin Panel   : http://localhost:8000/admin
echo.
echo   PENTING:
echo   - Jangan tutup jendela hitam ini selama menggunakan web!
echo   - HP/laptop teman harus terhubung ke Wi-Fi yang sama.
echo   - Untuk mematikan server, tekan Ctrl + C atau tutup jendela ini.
echo ========================================================
echo.

php artisan serve --host=0.0.0.0 --port=8000
