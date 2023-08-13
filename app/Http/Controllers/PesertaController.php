<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    public function index(){
        return view('peserta.index'); 
    }

    public function profile(){
        return view('peserta.profile'); 
    }

    public function updateProfile(Request $request){
        $user = auth()->user();
        
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'no_telpon' => 'required|numeric',
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
}