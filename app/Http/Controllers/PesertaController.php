<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skema;
use App\Models\Satker;
use App\Models\Pangkat;
use App\Models\PendidikanKepolisian;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiPesertaMail;

class PesertaController extends Controller
{
    public function index(){
        return view('peserta.index'); 
    }

    public function profile(){
        return view('peserta.profile', [
            'satkers' => Satker::all(), 
            'pangkats' => Pangkat::all(),
            'pendidikan_kepolisians' => PendidikanKepolisian::all(),
        ]); 
    }

    public function updateProfile(Request $request){
        $user = auth()->user();
        
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'no_telpon' => 'required|numeric',
            'email' => 'required|email',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'nip' => 'required|string',
            'jabatan' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'id_satker' => 'required',
            'id_pangkat' => 'required',
            'id_pendidikan_kepolisian' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg',
        ];

        if($request->email !== $user->email){
            $rules['email'] = 'required|email|unique:users';
        }
        $validatedData = $request->validate($rules);

        if($request->file('photo')){
            if($user->photo !== 'nopp.jpg'){
                Storage::delete($user->photo);
            }

            $validatedData['photo'] = str_replace('public/profile/', '', $request->file('photo')->store('public/profile'));
        }

        User::where('id_users', $user->id_users)->update($validatedData);

        // $username = User::firstWhere('id_users', $user->id)->email;

        return redirect("/peserta/profile")->with('success', 'A Profile Has Been Updated Successful!');
    }

    public function changePassword(Request $request)
    {
        return view('peserta.change_password');
    }

    public function saveChangePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Check if the current password matches the user's password in the database
        if (! Hash::check($request->input('old_password'), $user->password)) {
            return back()->withErrors(['old_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('peserta.changePassword')->with('success', 'Password changed successfully.');
    }

    public function showSkema(){
        return view('peserta.skema', [
            'skemas' => Skema::all(),
        ]);
    }

    public function detailSkema(Request $request, $skema){
        $skema = Skema::find($skema);
        return view('peserta.detail_skema', [
            'skema' => $skema,
        ]);
    }

    public function daftarSkema(Request $request, $skema){
        $skema = Skema::find($skema);
        return view('peserta.daftar_skema', [
            'skema' => $skema,
        ]);

    }
    
    public function saveDaftarSkema(Request $request, $skema){
        $skema = Skema::find($skema);
 
        $isUserValid = $this->hCheckUser();
        if(!$isUserValid){
            return redirect()->route('peserta.daftarSkema', $skema->id_skema)->with('failed', 'Data Diri Anda Belum Lengkapi. Lengkapi data diri anda!');
        }
        
        $isUserAlreadySignSkema = $this->hCheckIfUserAlreadySignSkema();
        if(!$isUserValid){
            return redirect()->route('peserta.daftarSkema', $skema->id_skema)->with('failed', 'Anda sudah melakukan pendaftaran pada skema, lihat status skema anda untuk info lebih lanjut');
        }


        $validatedData = $request->validate([
            'dokumen_persyaratan' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx',
        ]);

        $validatedData['id_users'] = auth()->user()->id_users;
        $validatedData['id_skema'] = $skema->id_skema;

        $pengajuan = new Pengajuan();
        $pengajuan->dokumen_persyaratan = $validatedData['dokumen_persyaratan'] = str_replace('public/dokumen_persyaratan/', '', $request->file('dokumen_persyaratan')->store('public/dokumen_persyaratan'));
        $pengajuan->id_users = $validatedData['id_users'];
        $pengajuan->id_skema = $validatedData['id_skema'];
        $pengajuan->is_disetujui = 'pending';

        $pengajuan->save();
        $this->sendEmail($validatedData['id_users'], $validatedData['id_skema']);
        return redirect()->route('peserta.daftarSkema', $skema->id_skema)->with('success', 'Berhasil mendaftar skema, silahkan tunggu konfirmasi dari admin melalui email anda!');
    }

    public function hCheckIfUserAlreadySignSkema($id_skema){
        $user = auth()->user();
        $skema = Skema::find($skema);

        if($skema->id_users === $user->id_users){
            return true;
        }
    }
    
    public function hCheckUser(){
        $user = auth()->user();


        if (!$user->jenis_kelamin) {
            return false;
        } elseif (!$user->nip) {
            return false;
        } elseif (!$user->jabatan) {
            return false;
        } elseif (!$user->tempat_lahir) {
            return false;
        } elseif (!$user->tanggal_lahir) {
            return false;
        } elseif (!$user->alamat) {
            return false;
        } elseif (!$user->kota) {
            return false;
        } elseif (!$user->provinsi) {
            return false;
        } elseif (!$user->pendidikan_terakhir) {
            return false;
        } elseif (!$user->id_satker) {
            return false;
        } elseif (!$user->id_pangkat) {
            return false;
        } elseif (!$user->id_pendidikan_kepolisian) {
            return false;
        }
    
        return true;
    }

    public function sendEmail($id_users, $id_skema){
        // Mail::to('kevinalmer4@gmail.com')->send(new NotifikasiPesertaMail());
        $user = User::find($id_users);
        $skema = Skema::find($id_skema);

        Mail::send(new NotifikasiPesertaMail(['user_email' => $user->email,'skema_name' =>  $skema->nama]));
        return 'berhasil';
    }
}