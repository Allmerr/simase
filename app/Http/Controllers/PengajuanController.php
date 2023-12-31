<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiPesertaAccPengajuanMail;
use App\Models\Notifikasi;
use App\Models\Pengajuan;
use App\Models\Skema;
use App\Models\StatusPeserta;
use App\Models\User;
use App\Models\LogEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengajuan.index', [
            // make order by date
            'pengajuans' => Pengajuan::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        return view('admin.pengajuan.show', [
            'pengajuan' => $pengajuan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }

    public function saveRevisi(Request $request, $id_pengajuan)
    {
        $revisi = [
            'catatan' => $request->catatan,
            'is_disetujui' => $request->is_disetujui,
        ];

        if (isset($request->file_syarat_ijazah_terakhir)) {
            $revisi['status_file_syarat_ijazah_terakhir'] = $request->file_syarat_ijazah_terakhir;
        }
        if (isset($request->file_syarat_sertifikat_pelatihan)) {
            $revisi['status_file_syarat_sertifikat_pelatihan'] = $request->file_syarat_sertifikat_pelatihan;
        }
        if (isset($request->file_syarat_sk_penempatan)) {
            $revisi['status_file_syarat_sk_penempatan'] = $request->file_syarat_sk_penempatan;
        }
        if (isset($request->file_syarat_sk_bebas_narkoba)) {
            $revisi['status_file_syarat_sk_bebas_narkoba'] = $request->file_syarat_sk_bebas_narkoba;
        }
        if (isset($request->file_syarat_sk_sehat)) {
            $revisi['status_file_syarat_sk_sehat'] = $request->file_syarat_sk_sehat;
        }
        if (isset($request->file_syarat_surat_rekomendasi_satker)) {
            $revisi['status_file_syarat_surat_rekomendasi_satker'] = $request->file_syarat_surat_rekomendasi_satker;
        }
        if (isset($request->file_syarat_nilai_e_rohani)) {
            $revisi['status_file_syarat_nilai_e_rohani'] = $request->file_syarat_nilai_e_rohani;
        }
        if (isset($request->file_syarat_smk_skp_terakhir)) {
            $revisi['status_file_syarat_smk_skp_terakhir'] = $request->file_syarat_smk_skp_terakhir;
        }
        if (isset($request->file_syarat_cv)) {
            $revisi['status_file_syarat_cv'] = $request->file_syarat_cv;
        }
        if (isset($request->file_syarat_pas_photo)) {
            $revisi['status_file_syarat_pas_photo'] = $request->file_syarat_pas_photo;
        }
        if (isset($request->file_syarat_sertifikat_keahlian_khusus)) {
            $revisi['status_file_syarat_sertifikat_keahlian_khusus'] = $request->file_syarat_sertifikat_keahlian_khusus;
        }
        if (isset($request->file_syarat_nilai_smk)) {
            $revisi['status_file_syarat_nilai_smk'] = $request->file_syarat_nilai_smk;
        }
        if (isset($request->file_syarat_keputusan_penyidik)) {
            $revisi['status_file_syarat_keputusan_penyidik'] = $request->file_syarat_keputusan_penyidik;
        }
        if (isset($request->file_syarat_skhp)) {
            $revisi['status_file_syarat_skhp'] = $request->file_syarat_skhp;
        }
        if (isset($request->file_syarat_dokumen_lainnya)) {
            $revisi['status_file_syarat_dokumen_lainnya'] = $request->file_syarat_dokumen_lainnya;
        }
        if (isset($request->file_syarat_sk_pangkat)) {
            $revisi['status_file_syarat_sk_pangkat'] = $request->file_syarat_sk_pangkat;
        }
        if (isset($request->file_syarat_identitas)) {
            $revisi['status_file_syarat_identitas'] = $request->file_syarat_identitas;
        }
        if (isset($request->file_syarat_dikbangpes)) {
            $revisi['status_file_syarat_dikbangpes'] = $request->file_syarat_dikbangpes;
        }
        if (isset($request->file_syarat_kep_jabatan)) {
            $revisi['status_file_syarat_kep_jabatan'] = $request->file_syarat_kep_jabatan;
        }
        if (isset($request->file_syarat_sprin_pelaksanaan_tugas)) {
            $revisi['status_file_syarat_sprin_pelaksanaan_tugas'] = $request->file_syarat_sprin_pelaksanaan_tugas;
        }

        if (isset($request->file_syarat_logbook)) {
            $revisi['status_file_syarat_logbook'] = $request->file_syarat_logbook;
        }

        Pengajuan::where('id_pengajuan', $id_pengajuan)->update($revisi);

        $pengajuan = Pengajuan::find($id_pengajuan);

        if ($revisi['is_disetujui'] == 'disetujui') {

            $status_peserta = new StatusPeserta();

            $status_peserta->status = 'diterima';
            $status_peserta->id_skema = $pengajuan->id_skema;
            $status_peserta->id_users = $pengajuan->id_users;

            $status_peserta->save();
        }

        $this->sendEmail($pengajuan->id_users, $pengajuan->id_skema, $pengajuan->is_disetujui);
        $this->sendNotifikasi($pengajuan);

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil menyetujui pengajuan!');
    }

    public function sendEmail($id_users, $id_skema, $status_acc)
    {
        // Mail::to('kevinalmer4@gmail.com')->send(new NotifikasiPesertaMail());
        $user = User::find($id_users);
        $skema = Skema::find($id_skema);

        try {
            $mail = Mail::send(new NotifikasiPesertaAccPengajuanMail(['user_email' => $user->email, 'skema_name' => $skema->nama, 'status_acc' => $status_acc]));

            if ($mail) {
                LogEmail::create([
                    'hal' => 'notifikasi persetujuan pengajuan peserta',
                    'email' => $user->email,
                    'status' => 'berhasil',
                ]);
            }

        } catch (\Throwable $th) {
            LogEmail::create([
                'hal' => 'notifikasi persetujuan pengajuan peserta',
                'email' => $user->email,
                'status' => 'gagal',
            ]);
        }

        return 'berhasil';
    }

    public function sendNotifikasi(Pengajuan $pengajuan)
    {
        $notifikasi = new Notifikasi();

        $notifikasi->judul = 'Pendaftaraan anda, pada skema '.$pengajuan->skema->nama;
        $notifikasi->pesan = 'Pendaftaran anda, pada skema '.$pengajuan->skema->nama.'telah '.$pengajuan->is_disetujui.'oleh admin, nantikan notifikasi terbaru.';
        $notifikasi->is_dibaca = 'tidak_dibaca';
        $notifikasi->id_users = $pengajuan->id_users;

        $notifikasi->save();
    }
}
