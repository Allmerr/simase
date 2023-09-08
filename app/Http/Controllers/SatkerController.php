<?php

namespace App\Http\Controllers;

use App\Models\Satker;
use Illuminate\Http\Request;

class SatkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.satker.index', [
            'satkers' => Satker::orderBy('id_satker', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.satker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        $satker = new Satker();

        $satker->nama = $validatedData['nama'];

        $satker->save();

        return redirect()->route('satker.index')->with('success', 'Data Satuan Kerja Has bBeen Added Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Satker $satker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satker $satker)
    {
        return view('admin.satker.edit', [
            'satker' => $satker,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Satker $satker)
    {
        $rules = [
            'nama' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Satker::where('id_satker', $satker->id_satker)->update($validatedData);

        return redirect()->route('satker.index', $satker->id_satker)->with('success', 'Data Satuan Kerja Has bBeen Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satker $satker)
    {
        Satker::destroy($satker->id_satker);

        return redirect()->route('satker.index')->with('success', 'Data Satuan Kerja Has bBeen Deleted Successful!');
    }
}