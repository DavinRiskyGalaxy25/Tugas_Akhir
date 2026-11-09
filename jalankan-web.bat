@echo off
title Web Sekolah SMP Al Ahmad Krian
color 0A

echo ========================================================
echo   MEMULAI SERVER WEB & DATABASE SMP AL AHMAD KRIAN
echo ========================================================
echo.

:: 1. Memeriksa apakah MySQL sudah aktif
echo [1/3] Memeriksa status database MySQL...
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo       [OK] Database MySQL sudah aktif.
) else (
    echo       [..] MySQL belum berjalan. Membuka Laragon...
    start "" "C:\laragon\laragon.exe"
    echo       Silakan klik "Start All" di Laragon jika belum otomatis aktif.
    timeout /t 4 /nobreak >nul
)

:: 2. Masuk ke direktori project
cd /d "%~dp0"

:: 3. Buka browser otomatis
echo.
echo [2/3] Menyiapkan browser...
timeout /t 2 /nobreak >nul
start http://0.0.0.0:8000

:: 4. Jalankan PHP Artisan Serve dengan host 0.0.0.0
echo.
echo [3/3] Menjalankan server di http://0.0.0.0:8000 ...
echo ========================================================
echo   * URL Website   : http://0.0.0.0:8000
echo   * Panel Admin   : http://0.0.0.0:8000/admin
echo.
echo   (Biarkan jendela ini tetap terbuka selama menggunakan web.
echo    Tekan tombol Ctrl + C jika ingin mematikan server).
echo ========================================================
echo.

php artisan serve --host=0.0.0.0 --port=8000
