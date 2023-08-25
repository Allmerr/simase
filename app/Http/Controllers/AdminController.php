<?php

namespace App\Http\Controllers;
use App\Models\StatusPeserta;
use App\Models\Pengajuan;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'jumlah_pendaftar' => Pengajuan::distinct('id_users')->count('id_users'),
            'peserta_aktif' => StatusPeserta::where('status', 'diterima')->distinct('id_users')->count('id_users'),
            'peserta_lulus' => StatusPeserta::where('status', 'lulus')->distinct('id_users')->count('id_users'),
            'pengajuans' => Pengajuan::all(),
        ]);
    }

    public function sertifikat(){
        return view('admin.sertifikat.index', [
            'status_pesertas' => StatusPeserta::where('status', 'lulus')->get(),
        ]);
    }
}