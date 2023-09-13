<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pekerjaan.index', [
            'pekerjaans' => Pekerjaan::orderBy('kode_pekerjaan', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pekerjaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kode_pekerjaan' => 'required|unique:pekerjaan,kode_pekerjaan',
            'nama_pekerjaan' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $pekerjaan = new Pekerjaan();

        $pekerjaan->kode_pekerjaan = $validatedData['kode_pekerjaan'];
        $pekerjaan->nama_pekerjaan = $validatedData['nama_pekerjaan'];

        $pekerjaan->save();

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan Has been added Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        return view('admin.pekerjaan.edit', [
            'pekerjaan' => $pekerjaan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $rules = [
            'kode_pekerjaan' => 'required|unique:pekerjaan,kode_pekerjaan,' . $pekerjaan->id_pekerjaan . ',id_pekerjaan',
            'nama_pekerjaan' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Pekerjaan::where('id_pekerjaan', $pekerjaan->id_pekerjaan)->update($validatedData);

        return redirect()->route('pekerjaan.index', $pekerjaan->id_pekerjaan)->with('success', 'Data pekerjaan Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        Pekerjaan::destroy($pekerjaan->id_pekerjaan);

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan Has Been Deleted Successful!');
    }
}