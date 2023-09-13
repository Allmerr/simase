<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\KotaKabupaten;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.provinsi.index', [
            'provinsis' => Provinsi::orderBy('kode_provinsi', 'ASC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kode_provinsi' => 'required|string|unique:provinsi,kode_provinsi',
            'nama_provinsi' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $provinsi = new Provinsi();

        $provinsi->kode_provinsi = $validatedData['kode_provinsi'];
        $provinsi->nama_provinsi = $validatedData['nama_provinsi'];

        $provinsi->save();

        return redirect()->route('provinsi.index')->with('success', 'A Provinsi Has been added Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi $provinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi $provinsi)
    {
        return view('admin.provinsi.edit', [
            'provinsi' => $provinsi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        $rules = [
            'kode_provinsi' => 'required|string',
            'nama_provinsi' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Provinsi::where('id_provinsi', $provinsi->id_provinsi)->update($validatedData);

        return redirect()->route('provinsi.index', $provinsi->id_provinsi)->with('success', 'A Provinsi Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi $provinsi)
    {
        $isHasChild = KotaKabupaten::where('kode_provinsi', $provinsi->kode_provinsi)->exists();

        if($isHasChild){
            return redirect()->route('provinsi.index')->with('error', 'Provinsi Kode/kabupaten Memiliki Relasi! Silahkan Hapus Data Di Tabel Relasi Terlebih Dahulu');
        }

        Provinsi::destroy($provinsi->id_provinsi);

        return redirect()->route('provinsi.index')->with('success', 'Data telah terhapus');
    }
}