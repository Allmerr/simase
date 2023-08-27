<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiPesertaAccPengajuanMail;
use App\Mail\NotifikasiPesertaMail;
use App\Models\Notifikasi;
use App\Models\Pangkat;
use App\Models\PendidikanKepolisian;
use App\Models\Pengajuan;
use App\Models\Satker;
use App\Models\Skema;
use App\Models\StatusPeserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PesertaController extends Controller
{
    public function index()
    {
        return view('peserta.index');
    }

    public function profile()
    {
        return view('peserta.profile', [
            'user' => auth()->user(),
            'satkers' => Satker::all(),
            'pangkats' => Pangkat::all(),
            'pendidikan_kepolisians' => PendidikanKepolisian::all(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'no_telpon' => 'required|numeric',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'nip' => 'required|string',
            'nik' => 'required|string',
            'jabatan' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'provinsi' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'dikbangspes' => 'required|string',
            'pelatihan_diikuti' => 'required|string',
            'keterampilan_khusus' => 'required|string',
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

        return redirect()->route('peserta.profile')->with('success', 'A Profile Has Been Updated Successful!');
    }

    public function changePassword(Request $request)
    {
        return view('peserta.change_password');
    }

    public function saveChangePassword(Request $request)
    {
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

        return redirect()->route('peserta.profile')->with('success', 'Password changed successfully.');
    }

    public function showSkema()
    {
        return view('peserta.skema', [
            'skemas' => Skema::all(),
        ]);
    }

    public function detailSkema(Request $request, $skema)
    {
        $skema = Skema::find($skema);

        return view('peserta.detail_skema', [
            'skema' => $skema,
        ]);
    }

    public function daftarSkema(Request $request, $skema)
    {
        $skema = Skema::find($skema);

        return view('peserta.daftar_skema', [
            'skema' => $skema,
        ]);

    }

    public function revisiSkema(Request $request, $id_skema)
    {
        $skema = Skema::find($id_skema);
        $pengajuan = Pengajuan::where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->get()->last();

        return view('peserta.revisi_skema', [
            'skema' => $skema,
            'pengajuan' => $pengajuan,
        ]);
    }

    public function saveRevisiSkema(Request $request, $id_skema)
    {
        $skema = Skema::find($id_skema);
        $pengajuan = Pengajuan::where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->get()->last();

        $validatedData['id_users'] = auth()->user()->id_users;
        $validatedData['id_skema'] = $skema->id_skema;

        if ($request->file('file_syarat_ktp')) {
            $pengajuan->file_syarat_ktp = $validatedData['file_syarat_ktp'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_ktp')->store('public/file_syarat'));
        }

        if ($request->file('file_syarat_kk')) {
            $pengajuan->file_syarat_kk = $validatedData['file_syarat_kk'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_kk')->store('public/file_syarat'));
        }

        if ($request->file('file_syarat_npwp')) {
            $pengajuan->file_syarat_npwp = $validatedData['file_syarat_npwp'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_npwp')->store('public/file_syarat'));
        }

        if ($request->file('file_syarat_logbook')) {
            $pengajuan->file_syarat_logbook = $validatedData['file_syarat_logbook'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_logbook')->store('public/file_syarat'));
        }

        $pengajuan->id_users = $validatedData['id_users'];
        $pengajuan->id_skema = $validatedData['id_skema'];
        $pengajuan->is_disetujui = 'pending_revisi';

        $pengajuan->update();
        $this->sendEmailAcc($validatedData['id_users'], $validatedData['id_skema']);

        return redirect()->route('peserta.statusPengajuan')->with('success', 'Berhasil melakukan revisi skema, silahkan tunggu konfirmasi dari admin melalui email anda!');
    }

    public function saveDaftarSkema(Request $request, $skema)
    {
        $skema = Skema::find($skema);

        $isUserValid = $this->hCheckUser();
        if (! $isUserValid) {
            return redirect()->route('peserta.daftarSkema', $skema->id_skema)->with('failed', 'Data Diri Anda Belum Lengkapi. Lengkapi data diri anda!');
        }

        $hasPreviousSubmission = Pengajuan::where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->get();
        $hasBeenLulus = StatusPeserta::where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->get();

        $rules = [
            'file_syarat_ktp' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_kk' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_npwp' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
        ];

        // sudah pernah pernah daftar
        if ($hasPreviousSubmission->count() > 0) {
            // sudah lulus dan sudah disetujui
            if ($hasBeenLulus->count() > 0) {
                if ($hasPreviousSubmission->last()->is_disetujui === 'disetujui' && $hasBeenLulus->last()->status === 'lulus') {
                    $rules['file_syarat_logbook'] = 'required|mimes:jpeg,png,jpg,pdf,doc,docx';
                }
            } elseif ($hasPreviousSubmission->last()->is_disetujui === 'tidak_disetujui') {
                // tidak melakukan apapa
            }
            // belum disetujui
            elseif ($hasPreviousSubmission->last()->is_disetujui !== 'disetujui') {
                return redirect()->route('peserta.daftarSkema', $skema->id_skema)->with('failed', 'Anda sudah melakukan pengajuan pada skema ini sebelumnya.');
            }
        }

        $validatedData = $request->validate($rules);

        $validatedData['id_users'] = auth()->user()->id_users;
        $validatedData['id_skema'] = $skema->id_skema;

        $pengajuan = new Pengajuan();

        if ($request->file('file_syarat_ktp')) {
            $pengajuan->file_syarat_ktp = $validatedData['file_syarat_ktp'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_ktp')->store('public/file_syarat'));
        }

        if ($request->file('file_syarat_kk')) {
            $pengajuan->file_syarat_kk = $validatedData['file_syarat_kk'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_kk')->store('public/file_syarat'));
        }

        if ($request->file('file_syarat_npwp')) {
            $pengajuan->file_syarat_npwp = $validatedData['file_syarat_npwp'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_npwp')->store('public/file_syarat'));
        }

        if ($request->file('file_syarat_logbook')) {
            $pengajuan->file_syarat_logbook = $validatedData['file_syarat_logbook'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_logbook')->store('public/file_syarat'));
        }

        $pengajuan->id_users = $validatedData['id_users'];
        $pengajuan->id_skema = $validatedData['id_skema'];
        $pengajuan->is_disetujui = 'pending';

        $pengajuan->save();
        $this->sendEmail($validatedData['id_users'], $validatedData['id_skema']);

        return redirect()->route('peserta.showSkema')->with('success', 'Berhasil mendaftar skema, silahkan tunggu konfirmasi dari admin melalui email anda!');
    }

    public function hCheckIfUserAlreadySignSkema($id_skema)
    {
        $user = auth()->user();
        $pengajuan = Pengajuan::where('id_skema', $id_skema)->get();

        if (isset($pengajuan->id_users)) {
            return false;
        }

        if ($pengajuan->id_users === $user->id_users) {
            return true;
        }

        return false;
    }

    public function hCheckUser()
    {
        $user = auth()->user();

        if (! $user->jenis_kelamin) {
            return false;
        } elseif (! $user->nik) {
            return false;
        } elseif (! $user->dikbangspes) {
            return false;
        } elseif (! $user->pelatihan_diikuti) {
            return false;
        } elseif (! $user->keterampilan_khusus) {
            return false;
        } elseif (! $user->nip) {
            return false;
        } elseif (! $user->jabatan) {
            return false;
        } elseif (! $user->tempat_lahir) {
            return false;
        } elseif (! $user->tanggal_lahir) {
            return false;
        } elseif (! $user->alamat) {
            return false;
        } elseif (! $user->kota) {
            return false;
        } elseif (! $user->provinsi) {
            return false;
        } elseif (! $user->pendidikan_terakhir) {
            return false;
        } elseif (! $user->id_satker) {
            return false;
        } elseif (! $user->id_pangkat) {
            return false;
        } elseif (! $user->id_pendidikan_kepolisian) {
            return false;
        }

        return true;
    }

    public function sendEmail($id_users, $id_skema)
    {
        $user = User::find($id_users);
        $skema = Skema::find($id_skema);

        Mail::send(new NotifikasiPesertaMail(['user_email' => $user->email, 'skema_name' => $skema->nama]));

        return 'berhasil';
    }

    public function sendEmailAcc($id_users, $id_skema)
    {
        $user = User::find($id_users);
        $skema = Skema::find($id_skema);

        Mail::send(new NotifikasiPesertaAccPengajuanMail(['user_email' => $user->email, 'skema_name' => $skema->nama, 'status_acc' => 'pending']));

        return 'berhasil';
    }

    public function notifikasi()
    {
        return view('peserta.notifikasi', [
            'notifikasis' => auth()->user()->notifikasi,
        ]);
    }

    public function notifikasiDetail(Request $request, $id_notifikasi)
    {
        $notifikasi = Notifikasi::find($id_notifikasi);

        if ($notifikasi->id_users !== auth()->user()->id_users) {
            return abort(403);
        }

        $notifikasi->is_dibaca = 'dibaca';

        $notifikasi->update();

        return view('peserta.notifikasi_detail', [
            'notifikasi' => $notifikasi,
        ]);
    }

    public function statusPengajuan()
    {
        $pengajuans = Pengajuan::where('id_users', auth()->user()->id_users)->get();

        return view('peserta.status_pengajuan', [
            'pengajuans' => $pengajuans,
        ]);
    }

    public function sertifikat()
    {
        $status_pesertas = StatusPeserta::where('id_users', auth()->user()->id_users)->where('status', 'lulus')->get();

        return view('peserta.sertifikat', [
            'status_pesertas' => $status_pesertas,
        ]);
    }
}
