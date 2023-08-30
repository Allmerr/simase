<?php

namespace App\Http\Controllers;

use App\Models\Tuk;
use Illuminate\Http\Request;

class TukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tuk.index', [
            'tuks' => Tuk::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tuk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $tuk = new Tuk();

        $tuk->nama = $validatedData['nama'];
        $tuk->alamat = $validatedData['alamat'];

        $tuk->save();

        return redirect()->route('tuk.index')->with('success', 'A Tuk Has been added Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tuk $tuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tuk $tuk)
    {
        return view('admin.tuk.edit', [
            'tuk' => $tuk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tuk $tuk)
    {
        $rules = [
            'nama' => 'required|string',
            'alamat' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Tuk::where('id_tuk', $tuk->id_tuk)->update($validatedData);

        return redirect()->route('tuk.index', $tuk->id_tuk)->with('success', 'A TUK Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tuk $tuk)
    {
        Tuk::destroy($tuk->id_tuk);

        return redirect()->route('tuk.index')->with('success_message', 'Data telah terhapus');
    }
}