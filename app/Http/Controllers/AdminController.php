<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\StatusPeserta;
use App\Models\User;
use App\Models\Satker;
use App\Models\Pangkat;
use App\Models\PendidikanKepolisian;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'jumlah_pendaftar' => Pengajuan::distinct('id_users')->count('id_users'),
            'peserta_aktif' => StatusPeserta::where('status', 'diterima')->distinct('id_users')->count('id_users'),
            'peserta_lulus' => StatusPeserta::where('status', 'lulus')->distinct('id_users')->count('id_users'),
            'pengajuans' => Pengajuan::all(),
        ]);
    }

    public function indexPeserta(){
        return view('admin.peserta.index', [
            'users' => User::where('role', 'peserta')->get(),
        ]);
    }

    public function showPeserta(Request $request, $id_users){
        $sertifikat_pesertas = StatusPeserta::where('id_users', $id_users)->where('status', 'lulus')->get();

        $sertifikat = '';
        if (count($sertifikat_pesertas) > 0) {
            foreach ($sertifikat_pesertas as $key => $value) {
                $sertifikat .= $value->skema->nama . ',';
            }
            substr_replace($sertifikat, "", -1);
        }else{
            $sertifikat = 'Belum pernah lulus dari skema apapun';
        }
        
        return view('admin.peserta.show', [
            'user' => User::where('role', 'peserta')->where('id_users', $id_users)->get()[0],
            'skema_diempuh' => $sertifikat,
        ]);
    }

    public function editPeserta(Request $request, $id_users){
        return view('admin.peserta.edit', [
            'satkers' => Satker::all(),
            'pangkats' => Pangkat::all(),
            'pendidikan_kepolisians' => PendidikanKepolisian::all(),
            'user' => User::where('role', 'peserta')->where('id_users', $id_users)->get()[0],
        ]);
    }

    public function updatePeserta(Request $request, $id_users){
        $user = User::where('id_users', $id_users)->get()[0];

        $rules = [
            'no_telpon' => 'numeric',
            'jenis_kelamin' => 'in:Laki-Laki,Perempuan',
            'nip' => 'string',
            'nik' => 'string',
            'jabatan' => 'string',
            'tempat_lahir' => 'string',
            'tanggal_lahir' => 'date',
            'alamat' => 'string',
            'kota' => 'string',
            'provinsi' => 'string',
            'pendidikan_terakhir' => 'string',
            'dikbangspes' => 'string',
            'pelatihan_diikuti' => 'string',
            'keterampilan_khusus' => 'string',
            'id_satker' => 'required',
            'id_pangkat' => 'required',
            'id_pendidikan_kepolisian' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg',
        ];
        $validatedData = $request->validate($rules);
        
        if ($request->file('photo')) {
            if ($user->photo !== 'nopp.jpg') {
                Storage::delete($user->photo);
            }
            
            $validatedData['photo'] = str_replace('public/profile/', '', $request->file('photo')->store('public/profile'));
        }
        
        User::where('id_users', $user->id_users)->update($validatedData);
        
        // dd($request, $rules);
        return redirect()->route('admin.peserta.index')->with('success', 'A Profile Has Been Updated Successful!');
    }

    public function destroyPeserta(Request $request, $id_users){
        User::destroy($id_users);

        return redirect()->route('admin.peserta.index')->with('success', 'Data telah terhapus');   
    }

    public function createPeserta(){
        return view('admin.peserta.create', [
            'satkers' => Satker::all(),
            'pangkats' => Pangkat::all(),
            'pendidikan_kepolisians' => PendidikanKepolisian::all(),
        ]);
    }

    public function storePeserta(Request $request){

        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telpon' => 'numeric',
            'jenis_kelamin' => 'in:Laki-Laki,Perempuan',
            'nip' => 'string',
            'nik' => 'string',
            'jabatan' => 'string',
            'tempat_lahir' => 'string',
            'tanggal_lahir' => 'date',
            'alamat' => 'string',
            'kota' => 'string',
            'provinsi' => 'string',
            'pendidikan_terakhir' => 'string',
            'dikbangspes' => 'string',
            'pelatihan_diikuti' => 'string',
            'keterampilan_khusus' => 'string',
            'id_satker' => 'required',
            'id_pangkat' => 'required',
            'id_pendidikan_kepolisian' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg',
        ];
        $validatedData = $request->validate($rules);
                
        // Simpan data pengguna (users)
        $user = new User();
        $user->nama_lengkap = $validatedData['nama_lengkap'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->no_telpon = $validatedData['no_telpon'];
        $user->jenis_kelamin = $validatedData['jenis_kelamin'];
        $user->nip = $validatedData['nip'];
        $user->nik = $validatedData['nik'];
        $user->jabatan = $validatedData['jabatan'];
        $user->tempat_lahir = $validatedData['tempat_lahir'];
        $user->tanggal_lahir = $validatedData['tanggal_lahir'];
        $user->alamat = $validatedData['alamat'];
        $user->kota = $validatedData['kota'];
        $user->provinsi = $validatedData['provinsi'];
        $user->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];
        $user->dikbangspes = $validatedData['dikbangspes'];
        $user->pelatihan_diikuti = $validatedData['pelatihan_diikuti'];
        $user->keterampilan_khusus = $validatedData['keterampilan_khusus'];
        $user->id_satker = $validatedData['id_satker'];
        $user->id_pangkat = $validatedData['id_pangkat'];
        $user->id_pendidikan_kepolisian = $validatedData['id_pendidikan_kepolisian'];

        $user->save();


        return redirect()->route('admin.peserta.index')->with('success', 'A Profile Has Been Updated Successful!');
    }
}