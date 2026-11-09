<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranPpdb;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class PpdbController extends Controller
{
    public function index(Request $request): View
    {
        $pendaftar = PendaftaranPpdb::when($request->filled('q'), function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('nama_lengkap', 'like', '%'.$request->q.'%')
                        ->orWhere('nik', 'like', '%'.$request->q.'%')
                        ->orWhere('asal_sekolah', 'like', '%'.$request->q.'%');
                });
            })
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.ppdb.index', compact('pendaftar'));
    }

    public function show(PendaftaranPpdb $ppdb): View
    {
        return view('admin.ppdb.show', ['pendaftar' => $ppdb]);
    }

    public function updateStatus(Request $request, PendaftaranPpdb $ppdb): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:menunggu,diverifikasi,diterima,ditolak'],
        ]);

        $ppdb->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(PendaftaranPpdb $ppdb): RedirectResponse
    {
        $ppdb->delete();

        return redirect()->route('admin.ppdb.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function export(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $filename = 'pendaftar-ppdb-'.now()->format('Ymd-His').'.csv';

        $columns = ['Nama Lengkap', 'NIK', 'NISN', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Alamat', 'No HP', 'Asal Sekolah', 'Nama Wali', 'No HP Wali', 'Email', 'Status', 'Tanggal Daftar'];

        return Response::streamDownload(function () use ($columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            PendaftaranPpdb::orderBy('created_at')->chunk(100, function ($rows) use ($handle) {
                foreach ($rows as $row) {
                    fputcsv($handle, [
                        $row->nama_lengkap, $row->nik, $row->nisn, $row->tempat_lahir,
                        optional($row->tanggal_lahir)->format('d-m-Y'), $row->jenis_kelamin,
                        $row->alamat, $row->no_hp, $row->asal_sekolah, $row->nama_wali,
                        $row->no_hp_wali, $row->email, $row->status, $row->created_at->format('d-m-Y H:i'),
                    ]);
                }
            });

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
