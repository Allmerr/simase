<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengajuan.index', [
            'pengajuans' => Pengajuan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }

    public function terima(Request $request, $id_pengajuan)
    {
        $pengajuan = Pengajuan::find($id_pengajuan);

        return view('admin.pengajuan.terima', [
            'pengajuan' => $pengajuan,
        ]);
    }

    public function saveTerima(Request $request, $id_pengajuan)
    {
        Pengajuan::where('id_pengajuan', $id_pengajuan)->update([
            'is_disetujui' => true,
        ]);

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil mendaftar skema, silahkan tunggu konfirmasi dari admin melalui email anda!');
    }
}
