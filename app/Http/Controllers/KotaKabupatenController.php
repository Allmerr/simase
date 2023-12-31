<?php

namespace App\Http\Controllers;

use App\Models\KotaKabupaten;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;

class KotaKabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kotaKabupatens = KotaKabupaten::select('kota_kabupaten.*')
            ->join('provinsi', 'provinsi.kode_provinsi', '=', 'kota_kabupaten.kode_provinsi')
            ->orderBy('provinsi.nama_provinsi', 'asc')
            ->orderBy('kota_kabupaten.kode_kota_kabupaten', 'asc')
            ->get();

        return view('admin.kota_kabupaten.index', [
            'kota_kabupatens' => $kotaKabupatens,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kota_kabupaten.create', [
            'provinsis' => Provinsi::orderBy('kode_provinsi', 'asc')->get(),
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
            'kode_kota_kabupaten' => 'required|unique:kota_kabupaten,kode_kota_kabupaten',
        ];

        $validatedData = $request->validate($rules);

        $kotaKabupaten = new KotaKabupaten();

        $kotaKabupaten->kode_provinsi = $validatedData['kode_provinsi'];
        $kotaKabupaten->nama_kota_kabupaten = $validatedData['nama_kota_kabupaten'];
        $kotaKabupaten->kode_kota_kabupaten = $validatedData['kode_kota_kabupaten'];

        $kotaKabupaten->save();

        return redirect()->route('kota-kabupaten.index')->with('success', 'Data Kota/Kab Has Been Added Successful!');
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
            'provinsis' => Provinsi::orderBy('kode_provinsi', 'asc')->get(),
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
            'kode_kota_kabupaten' => 'required|unique:kota_kabupaten,kode_kota_kabupaten,'.$kotaKabupaten->id_kota_kabupaten.',id_kota_kabupaten',
        ];

        $validatedData = $request->validate($rules);

        KotaKabupaten::where('id_kota_kabupaten', $kotaKabupaten->id_kota_kabupaten)->update($validatedData);

        return redirect()->route('kota-kabupaten.index', $kotaKabupaten->id_kota_kabupaten)->with('success', 'Data Kota/Kab Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KotaKabupaten $kotaKabupaten)
    {
        $isHasChild = User::where('kode_kota_kabupaten', $kotaKabupaten->kode_kota_kabupaten)->exists();

        if ($isHasChild) {
            return redirect()->route('kota-kabupaten.index')->with('error', 'Kode/kabupaten Memiliki Relasi! Silahkan Hapus Data Di Tabel Relasi Terlebih Dahulu');
        }

        KotaKabupaten::destroy($kotaKabupaten->id_kota_kabupaten);

        return redirect()->route('kota-kabupaten.index')->with('success', 'Data telah terhapus');
    }
}
