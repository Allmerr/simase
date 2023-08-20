<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skemas = Skema::all();

        return view('admin.skema.index', [
            'skemas' => $skemas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required|string|max:6',
            'nama' => 'required|string',
            'persyaratan' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg',
        ];

        $fileSyarat = '';
        
        if(isset($request->file_syarat_ktp)){
            $fileSyarat .= ',file_syarat_ktp';
        }
        if(isset($request->file_syarat_kk)){
            $fileSyarat .= ',file_syarat_kk';
        }
        if(isset($request->file_syarat_npwp)){
            $fileSyarat .= ',file_syarat_npwp';
        }
        
        if($fileSyarat !== ''){
            $fileSyarat = substr($fileSyarat, 1);
        }

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            $validatedData['photo'] = str_replace('public/skema/', '', $request->file('photo')->store('public/skema'));
        }

        $skema = new Skema();

        $skema->kode = $validatedData['kode'];
        $skema->nama = $validatedData['nama'];
        $skema->persyaratan = $validatedData['persyaratan'];
        $skema->file_syarat = $fileSyarat;
        
        if ($request->file('photo')) {
            $skema->photo = $validatedData['photo'];
        }

        $skema->save();

        return redirect()->route('skema.index')->with('success', 'A Profile Has Been Updated Successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skema $skema)
    {
        return view('admin.skema.show', [
            'skema' => $skema,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skema $skema)
    {
        return view('admin.skema.edit', [
            'skema' => $skema,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skema $skema)
    {
        $rules = [
            'kode' => 'required|string|max:6',
            'nama' => 'required|string',
            'persyaratan' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg',
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            if ($skema->photo !== 'noskema.jpg') {
                Storage::delete($skema->photo);
            }

            $validatedData['photo'] = str_replace('public/skema/', '', $request->file('photo')->store('public/skema'));
        }

        // dd($validatedData);

        Skema::where('id_skema', $skema->id_skema)->update($validatedData);

        // $username = User::firstWhere('id_users', $user->id)->email;

        return redirect()->route('skema.edit', $skema->id_skema)->with('success', 'A Profile Has Been Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skema $skema)
    {
        Skema::destroy($skema->id_skema);

        return redirect()->route('skema.index')->with('success_message', 'Data telah terhapus');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('file')->storeAs('public/uploads', $filenametostore);

            // you can save image path below in database
            $path = asset('storage/uploads/'.$filenametostore);

            echo $path;
            exit;
        }
    }

    public function pesertaSkema(Request $request, $id_skema)
    {
        $skema = Skema::find($id_skema);

        return view('admin.skema.peserta', [
            'skema' => $skema,
        ]);
    }
}