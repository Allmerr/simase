<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiPesertaAccPengajuanMail;
use App\Models\Notifikasi;
use App\Models\Pengajuan;
use App\Models\Skema;
use App\Models\StatusPeserta;
use App\Models\User;
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
            'pengajuans' => Pengajuan::all(),
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

    public function terima(Request $request, $id_pengajuan)
    {
        Pengajuan::where('id_pengajuan', $id_pengajuan)->update([
            'is_disetujui' => 'disetujui',
        ]);

        $pengajuan = Pengajuan::find($id_pengajuan);

        $this->sendEmail($pengajuan->id_users, $pengajuan->id_skema, $pengajuan->is_disetujui);
        $this->sendNotifikasi($pengajuan);

        $status_peserta = new StatusPeserta();

        $status_peserta->status = 'diterima';
        $status_peserta->id_skema = $pengajuan->id_skema;
        $status_peserta->id_users = $pengajuan->id_users;

        $status_peserta->save();

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil mendaftar skema, silahkan tunggu konfirmasi dari admin melalui email anda!');

    }

    public function tolak(Request $request, $id_pengajuan)
    {
        Pengajuan::where('id_pengajuan', $id_pengajuan)->update([
            'is_disetujui' => 'tidak_disetujui',
        ]);

        $pengajuan = Pengajuan::find($id_pengajuan);

        $this->sendEmail($pengajuan->id_users, $pengajuan->id_skema, $pengajuan->is_disetujui);
        $this->sendNotifikasi($pengajuan);

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil mendaftar skema, silahkan tunggu konfirmasi dari admin melalui email anda!');

    }

    public function revisi(Request $request, $id_pengajuan)
    {
        $pengajuan = Pengajuan::find($id_pengajuan);

        return view('admin.pengajuan.revisi', [
            'pengajuan' => $pengajuan,
        ]);
    }

    public function saveRevisi(Request $request, $id_pengajuan)
    {
        $revisi = [
            'is_disetujui' => 'revisi',
            'catatan' => $request->catatan,
            'is_disetujui' => $request->is_disetujui,
        ];

        if (isset($request->file_syarat_ktp)) {
            $revisi['status_file_syarat_ktp'] = $request->file_syarat_ktp;
        }
        if (isset($request->file_syarat_kk)) {
            $revisi['status_file_syarat_kk'] = $request->file_syarat_kk;
        }
        if (isset($request->file_syarat_npwp)) {
            $revisi['status_file_syarat_npwp'] = $request->file_syarat_npwp;
        }
        if (isset($request->file_syarat_logbook)) {
            $revisi['status_file_syarat_logbook'] = $request->file_syarat_logbook;
        }

        Pengajuan::where('id_pengajuan', $id_pengajuan)->update($revisi);

        $pengajuan = Pengajuan::find($id_pengajuan);

        $status_peserta = new StatusPeserta();

        $status_peserta->status = 'diterima';
        $status_peserta->id_skema = $pengajuan->id_skema;
        $status_peserta->id_users = $pengajuan->id_users;

        $status_peserta->save();

        $this->sendEmail($pengajuan->id_users, $pengajuan->id_skema, $pengajuan->is_disetujui);
        $this->sendNotifikasi($pengajuan);

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil mendaftar skema, silahkan tunggu konfirmasi dari admin melalui email anda!');
    }

    public function sendEmail($id_users, $id_skema, $status_acc)
    {
        // Mail::to('kevinalmer4@gmail.com')->send(new NotifikasiPesertaMail());
        $user = User::find($id_users);
        $skema = Skema::find($id_skema);

        Mail::send(new NotifikasiPesertaAccPengajuanMail(['user_email' => $user->email, 'skema_name' => $skema->nama, 'status_acc' => $status_acc]));

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
