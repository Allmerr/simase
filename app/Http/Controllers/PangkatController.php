<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pangkat.index', [
            'pangkats' => Pangkat::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pangkat.create');
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

        $pangkat = new Pangkat();

        $pangkat->nama = $validatedData['nama'];

        $pangkat->save();

        return redirect()->route('pangkat.index')->with('success', 'A Profile Has Been Updated Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pangkat $pangkat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pangkat $pangkat)
    {
        return view('admin.pangkat.edit', [
            'pangkat' => $pangkat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pangkat $pangkat)
    {
        $rules = [
            'nama' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        Pangkat::where('id_pangkat', $pangkat->id_pangkat)->update($validatedData);

        return redirect()->route('pangkat.index', $pangkat->id_pangkat)->with('success', 'A Profile Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pangkat $pangkat)
    {
        Pangkat::destroy($pangkat->id_pangkat);

        return redirect()->route('pangkat.index')->with('success_message', 'Data telah terhapus');
    }
}
