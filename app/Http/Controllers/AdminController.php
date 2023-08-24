<?php

namespace App\Http\Controllers;
use App\Models\StatusPeserta;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function sertifikat(){
        return view('admin.sertifikat.index', [
            'status_pesertas' => StatusPeserta::where('status', 'lulus')->get(),
        ]);
    }
}