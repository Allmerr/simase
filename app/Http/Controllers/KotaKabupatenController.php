<?php

namespace App\Http\Controllers;

use App\Models\KotaKabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KotaKabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.kota_kabupaten.index', [
            'kota_kabupatens' => KotaKabupaten::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kota_kabupaten.create', [
            'provinsis' => Provinsi::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kode_provinsi' => 'required',
            'nama_kota_kabupaten' => 'required',
            'kode_kota_kabupaten' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $kotaKabupaten = new KotaKabupaten();

        $kotaKabupaten->kode_provinsi = $validatedData['kode_provinsi'];
        $kotaKabupaten->nama_kota_kabupaten = $validatedData['nama_kota_kabupaten'];
        $kotaKabupaten->kode_kota_kabupaten = $validatedData['kode_kota_kabupaten'];

        $kotaKabupaten->save();

        return redirect()->route('kota-kabupaten.index')->with('success', 'A Profile Has Been Updated Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KotaKabupaten $kotaKabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KotaKabupaten $kotaKabupaten)
    {
        return view('admin.kota_kabupaten.edit', [
            'kota_kabupaten' => $kotaKabupaten,
            'provinsis' => Provinsi::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KotaKabupaten $kotaKabupaten)
    {
        $rules = [
            'kode_provinsi' => 'required',
            'nama_kota_kabupaten' => 'required',
            'kode_kota_kabupaten' => 'required',
        ];

        $validatedData = $request->validate($rules);

        KotaKabupaten::where('id_kota_kabupaten', $kotaKabupaten->id_kota_kabupaten)->update($validatedData);

        return redirect()->route('kota-kabupaten.index', $kotaKabupaten->id_kota_kabupaten)->with('success', 'A Profile Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KotaKabupaten $kotaKabupaten)
    {
        KotaKabupaten::destroy($kotaKabupaten->id_kota_kabupaten);

        return redirect()->route('kota-kabupaten.index')->with('success', 'Data telah terhapus');
    }
}