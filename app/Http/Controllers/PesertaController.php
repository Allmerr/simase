<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiPesertaAccPengajuanMail;
use App\Mail\NotifikasiPesertaMail;
use App\Models\KotaKabupaten;
use App\Models\Notifikasi;
use App\Models\Pangkat;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\PendidikanKepolisian;
use App\Models\Pengajuan;
use App\Models\Provinsi;
use App\Models\Satker;
use App\Models\Skema;
use App\Models\StatusPeserta;
use App\Models\Tuk;
use App\Models\User;
use App\Models\Survey;
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
            'satkers' => Satker::orderBy('nama', 'ASC')->get(),
            'pangkats' => Pangkat::orderBy('nama', 'ASC')->get(),
            'pendidikan_kepolisians' => PendidikanKepolisian::orderBy('nama', 'ASC')->get(),
            'provinsis' => Provinsi::orderBy('nama_provinsi', 'ASC')->get(),
            'kota_kabupatens' => KotaKabupaten::orderBy('nama_kota_kabupaten', 'ASC')->get(),
            'pendidikans' => Pendidikan::orderBy('nama_pendidikan', 'ASC')->get(),
            'pekerjaans' => Pekerjaan::orderBy('nama_pekerjaan', 'ASC')->get(),
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
            'kode_kota_kabupaten' => 'required',
            'kode_provinsi' => 'required',
            'kode_pendidikan' => 'required',
            'kode_pekerjaan' => 'required',
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
            'tuks' => Tuk::all(),
        ]);

    }

    public function revisiSkema(Request $request, $id_skema)
    {
        $skema = Skema::find($id_skema);
        $pengajuan = Pengajuan::where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->get()->last();

        return view('peserta.revisi_skema', [
            'skema' => $skema,
            'pengajuan' => $pengajuan,
            'tuks' => Tuk::all(),
        ]);
    }

    public function saveRevisiSkema(Request $request, $id_skema)
    {
        $skema = Skema::find($id_skema);
        $pengajuan = Pengajuan::where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->get()->last();

        $validatedData['id_users'] = auth()->user()->id_users;
        $validatedData['id_skema'] = $skema->id_skema;
        $validatedData['id_tuk'] = $request->id_tuk;

        if ($request->file('file_syarat_ijazah_terakhir')) {
            $pengajuan->file_syarat_ijazah_terakhir = $validatedData['file_syarat_ijazah_terakhir'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_ijazah_terakhir')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sertifikat_pelatihan')) {
            $pengajuan->file_syarat_sertifikat_pelatihan = $validatedData['file_syarat_sertifikat_pelatihan'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sertifikat_pelatihan')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sk_penempatan')) {
            $pengajuan->file_syarat_sk_penempatan = $validatedData['file_syarat_sk_penempatan'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sk_penempatan')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sk_bebas_narkoba')) {
            $pengajuan->file_syarat_sk_bebas_narkoba = $validatedData['file_syarat_sk_bebas_narkoba'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sk_bebas_narkoba')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sk_sehat')) {
            $pengajuan->file_syarat_sk_sehat = $validatedData['file_syarat_sk_sehat'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sk_sehat')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_surat_rekomendasi_satker')) {
            $pengajuan->file_syarat_surat_rekomendasi_satker = $validatedData['file_syarat_surat_rekomendasi_satker'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_surat_rekomendasi_satker')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_nilai_e_rohani')) {
            $pengajuan->file_syarat_nilai_e_rohani = $validatedData['file_syarat_nilai_e_rohani'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_nilai_e_rohani')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_smk_skp_terakhir')) {
            $pengajuan->file_syarat_smk_skp_terakhir = $validatedData['file_syarat_smk_skp_terakhir'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_smk_skp_terakhir')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_cv')) {
            $pengajuan->file_syarat_cv = $validatedData['file_syarat_cv'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_cv')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_pas_photo')) {
            $pengajuan->file_syarat_pas_photo = $validatedData['file_syarat_pas_photo'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_pas_photo')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sertifikat_keahlian_khusus')) {
            $pengajuan->file_syarat_sertifikat_keahlian_khusus = $validatedData['file_syarat_sertifikat_keahlian_khusus'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sertifikat_keahlian_khusus')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_nilai_smk')) {
            $pengajuan->file_syarat_nilai_smk = $validatedData['file_syarat_nilai_smk'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_nilai_smk')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_keputusan_penyidik')) {
            $pengajuan->file_syarat_keputusan_penyidik = $validatedData['file_syarat_keputusan_penyidik'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_keputusan_penyidik')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_skhp')) {
            $pengajuan->file_syarat_skhp = $validatedData['file_syarat_skhp'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_skhp')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_dokumen_lainnya')) {
            $pengajuan->file_syarat_dokumen_lainnya = $validatedData['file_syarat_dokumen_lainnya'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_dokumen_lainnya')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sk_pangkat')) {
            $pengajuan->file_syarat_sk_pangkat = $validatedData['file_syarat_sk_pangkat'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sk_pangkat')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_identitas')) {
            $pengajuan->file_syarat_identitas = $validatedData['file_syarat_identitas'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_identitas')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_dikbangpes')) {
            $pengajuan->file_syarat_dikbangpes = $validatedData['file_syarat_dikbangpes'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_dikbangpes')->store('public/file_syarat'));
        }


        if ($request->file('file_syarat_logbook')) {
            $pengajuan->file_syarat_logbook = $validatedData['file_syarat_logbook'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_logbook')->store('public/file_syarat'));
        }

        $pengajuan->id_users = $validatedData['id_users'];
        $pengajuan->id_skema = $validatedData['id_skema'];
        $pengajuan->id_tuk = $validatedData['id_tuk'];
        $pengajuan->is_disetujui = 'pending';

        $pengajuan->update();
        $this->sendEmailAcc($validatedData['id_users'], $validatedData['id_skema']);

        return redirect()->route('peserta.statusPengajuan')->with('success', 'Berhasil melakukan revisi skema, silahkan tunggu konfirmasi dari admin melalui email anda!');
    }

    public function saveDaftarSkema(Request $request, $skema)
    {
        $skema = Skema::find($skema);

        $isUserValid = $this->hCheckUser();
        if (! $isUserValid) {
            return redirect()->route('peserta.daftarSkema', $skema->id_skema)->with('failed', 'Data Diri Anda Belum Lengkapi. Lengkapi data diri, photo profile anda!');
        }

        $notFillSurvey = isset(StatusPeserta::where('id_skema', $skema->id_skema)->where('id_users', auth()->user()->id_users)->whereDate('tanggal_surveilan', '<=', today())->where('sudah_servey', 'belum')->get()[0]);

        if($notFillSurvey){
            return redirect()->route('peserta.daftarSkema', $skema->id_skema)->with('failed', 'Mohon isi survey telebih dahulu!');
        }


        $hasPreviousSubmission = Pengajuan::where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->get();
        $hasBeenLulus = StatusPeserta::where('id_users', auth()->user()->id_users)->where('id_skema', $skema->id_skema)->get();

        $rules = [
            'file_syarat_ijazah_terakhir' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_sertifikat_pelatihan' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_sk_penempatan' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_sk_bebas_narkoba' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_sk_sehat' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_surat_rekomendasi_satker' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_nilai_e_rohani' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_smk_skp_terakhir' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_cv' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_pas_photo' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_sertifikat_keahlian_khusus' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_nilai_smk' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_keputusan_penyidik' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_skhp' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_dokumen_lainnya' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_sk_pangkat' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_identitas' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'file_syarat_dikbangpes' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'id_tuk' => 'required',
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

        if ($request->file('file_syarat_ijazah_terakhir')) {
            $pengajuan->file_syarat_ijazah_terakhir = $validatedData['file_syarat_ijazah_terakhir'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_ijazah_terakhir')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sertifikat_pelatihan')) {
            $pengajuan->file_syarat_sertifikat_pelatihan = $validatedData['file_syarat_sertifikat_pelatihan'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sertifikat_pelatihan')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sk_penempatan')) {
            $pengajuan->file_syarat_sk_penempatan = $validatedData['file_syarat_sk_penempatan'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sk_penempatan')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sk_bebas_narkoba')) {
            $pengajuan->file_syarat_sk_bebas_narkoba = $validatedData['file_syarat_sk_bebas_narkoba'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sk_bebas_narkoba')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sk_sehat')) {
            $pengajuan->file_syarat_sk_sehat = $validatedData['file_syarat_sk_sehat'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sk_sehat')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_surat_rekomendasi_satker')) {
            $pengajuan->file_syarat_surat_rekomendasi_satker = $validatedData['file_syarat_surat_rekomendasi_satker'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_surat_rekomendasi_satker')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_nilai_e_rohani')) {
            $pengajuan->file_syarat_nilai_e_rohani = $validatedData['file_syarat_nilai_e_rohani'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_nilai_e_rohani')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_smk_skp_terakhir')) {
            $pengajuan->file_syarat_smk_skp_terakhir = $validatedData['file_syarat_smk_skp_terakhir'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_smk_skp_terakhir')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_cv')) {
            $pengajuan->file_syarat_cv = $validatedData['file_syarat_cv'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_cv')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_pas_photo')) {
            $pengajuan->file_syarat_pas_photo = $validatedData['file_syarat_pas_photo'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_pas_photo')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sertifikat_keahlian_khusus')) {
            $pengajuan->file_syarat_sertifikat_keahlian_khusus = $validatedData['file_syarat_sertifikat_keahlian_khusus'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sertifikat_keahlian_khusus')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_nilai_smk')) {
            $pengajuan->file_syarat_nilai_smk = $validatedData['file_syarat_nilai_smk'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_nilai_smk')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_keputusan_penyidik')) {
            $pengajuan->file_syarat_keputusan_penyidik = $validatedData['file_syarat_keputusan_penyidik'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_keputusan_penyidik')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_skhp')) {
            $pengajuan->file_syarat_skhp = $validatedData['file_syarat_skhp'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_skhp')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_dokumen_lainnya')) {
            $pengajuan->file_syarat_dokumen_lainnya = $validatedData['file_syarat_dokumen_lainnya'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_dokumen_lainnya')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_sk_pangkat')) {
            $pengajuan->file_syarat_sk_pangkat = $validatedData['file_syarat_sk_pangkat'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_sk_pangkat')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_identitas')) {
            $pengajuan->file_syarat_identitas = $validatedData['file_syarat_identitas'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_identitas')->store('public/file_syarat'));
        }
        if ($request->file('file_syarat_dikbangpes')) {
            $pengajuan->file_syarat_dikbangpes = $validatedData['file_syarat_dikbangpes'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_dikbangpes')->store('public/file_syarat'));
        }

        if ($request->file('file_syarat_logbook')) {
            $pengajuan->file_syarat_logbook = $validatedData['file_syarat_logbook'] = str_replace('public/file_syarat/', '', $request->file('file_syarat_logbook')->store('public/file_syarat'));
        }

        $pengajuan->id_users = $validatedData['id_users'];
        $pengajuan->id_skema = $validatedData['id_skema'];
        $pengajuan->id_tuk = $validatedData['id_tuk'];
        $pengajuan->is_disetujui = 'menunggu_pending';

        if (isset($validatedData['file_syarat_logbook'])) {
            $pengajuan->jenis_pengajuan = 'perpanjang';
        }

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
        } elseif (! $user->kode_kota_kabupaten) {
            return false;
        } elseif (! $user->kode_provinsi) {
            return false;
        } elseif (! $user->kode_pendidikan) {
            return false;
        } elseif (! $user->id_satker) {
            return false;
        } elseif (! $user->id_pangkat) {
            return false;
        } elseif (! $user->id_pendidikan_kepolisian) {
            return false;
        } elseif (! $user->kode_pekerjaan) {
            return false;
        } elseif ($user->photo == 'nopp.png') {
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

        if ($notifikasi->id_users != auth()->user()->id_users) {
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
        $status_pesertas = StatusPeserta::where('id_users', auth()->user()->id_users)->where('status', 'lulus')->where('file_sertifikat', '!=', '')->get();

        return view('peserta.sertifikat', [
            'status_pesertas' => $status_pesertas,
        ]);
    }

    public function getKotaKabupaten($kode_provinsi)
    {
        $kotaKabupaten = KotaKabupaten::where('kode_provinsi', $kode_provinsi)->get();

        return response()->json(['kota_kabupatens' => $kotaKabupaten]);
    }

    public function notifications()
    {
        // For the sake of simplicity, assume we have a variable called
        // $notifications with the unread notifications. Each notification
        // have the next properties:
        // icon: An icon for the notification.
        // text: A text for the notification.
        // time: The time since notification was created on the server.
        // At next, we define a hardcoded variable with the explained format,
        // but you can assume this data comes from a database query.

        $notifications = [];

        foreach (auth()->user()->notifikasi as $key => $notifikasi) {
            $notifications[] = [
                'icon' => 'fas fa-fw fa-envelope',
                'text' => 'Pesan Belum Dibaca',
                'time' => '',
            ];
        }

        // Now, we create the notification dropdown main content.

        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";

            $time = "<span class='float-right text-muted text-sm'>
                    {$not['time']}
                    </span>";

            $dropdownHtml .= "<a href='/peserta/notifikasi' class='dropdown-item'>
                                {$icon}{$not['text']}{$time}
                            </a>";

            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.

        return [
            'label' => count($notifications),
            'label_color' => 'danger',
            'icon_color' => 'dark',
            'dropdown' => $dropdownHtml,
        ];

    }
}