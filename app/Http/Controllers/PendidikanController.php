<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pendidikan.index', [
            'pendidikans' => Pendidikan::orderBy('id_pendidikan', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pendidikan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kode_pendidikan' => 'required|string',
            'nama_pendidikan' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $pendidikan = new Pendidikan();

        $pendidikan->kode_pendidikan = $validatedData['kode_pendidikan'];
        $pendidikan->nama_pendidikan = $validatedData['nama_pendidikan'];

        $pendidikan->save();

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan Has bBeen Added Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendidikan $pendidikan)
    {
        return view('admin.pendidikan.edit', [
            'pendidikan' => $pendidikan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
        $rules = [
            'kode_pendidikan' => 'required',
            'nama_pendidikan' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Pendidikan::where('id_pendidikan', $pendidikan->id_pendidikan)->update($validatedData);

        return redirect()->route('pendidikan.index', $pendidikan->id_pendidikan)->with('success', 'Data pendidikan Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendidikan $pendidikan)
    {
        Pendidikan::destroy($pendidikan->id_pendidikan);

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan Has Been Deleted Successful!');
    }
}