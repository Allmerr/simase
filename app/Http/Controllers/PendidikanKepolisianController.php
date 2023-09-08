<?php

namespace App\Http\Controllers;

use App\Models\PendidikanKepolisian;
use Illuminate\Http\Request;

class PendidikanKepolisianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pendidikan_kepolisian.index', [
            'pendidikan_kepolisians' => PendidikanKepolisian::orderBy('id_pendidikan_kepolisian', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pendidikan_kepolisian.create');
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

        $pendidikan_kepolisian = new PendidikanKepolisian();

        $pendidikan_kepolisian->nama = $validatedData['nama'];

        $pendidikan_kepolisian->save();

        return redirect()->route('pendidikan-kepolisian.index')->with('success', 'Data Pendidikan Kepolisian Has Been Added Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PendidikanKepolisian $pendidikan_kepolisian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendidikanKepolisian $pendidikan_kepolisian)
    {
        return view('admin.pendidikan_kepolisian.edit', [
            'pendidikan_kepolisian' => $pendidikan_kepolisian,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PendidikanKepolisian $pendidikan_kepolisian)
    {
        $rules = [
            'nama' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        PendidikanKepolisian::where('id_pendidikan_kepolisian', $pendidikan_kepolisian->id_pendidikan_kepolisian)->update($validatedData);

        return redirect()->route('pendidikan-kepolisian.index', $pendidikan_kepolisian->id_pendidikan_kepolisian)->with('success', 'Data Pendidikan Kepolisian Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendidikanKepolisian $pendidikan_kepolisian)
    {
        PendidikanKepolisian::destroy($pendidikan_kepolisian->id_pendidikan_kepolisian);

        return redirect()->route('pendidikan-kepolisian.index')->with('success_message', 'Data Pendidikan Kepolisian Has Been Deleted Successful!');
    }
}