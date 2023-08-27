<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\StatusPeserta;

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
}
