<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiSertifikatMail;
use App\Models\Notifikasi;
use App\Models\Skema;
use App\Models\StatusPeserta;
use App\Models\LogEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SertifikatController extends Controller
{
    public function index()
    {
        return view('admin.sertifikat.index', [
            'status_pesertas' => StatusPeserta::where('status', 'lulus')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sertifikat.create', [
            'skemas' => Skema::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_skema' => 'required',
            'id_user' => 'required',
            'tanggal_penetapan' => 'required|date',
            'nomor_blanko' => 'required|string',
            'nomor_registrasi' => 'required|string',
            'file_sertifikat' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx',
        ]);

        StatusPeserta::where('id_skema', $request->id_skema)->where('id_users', $request->id_user)->update([
            'nomor_blanko' => $request->nomor_blanko,
            'nomor_registrasi' => $request->nomor_registrasi,
            'tanggal_penetapan' => $request->tanggal_penetapan,
            'tanggal_surveilan' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addYears(1),
            'tanggal_notif_expired' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addMonths(33),
            'tanggal_expired' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addYears(3),
            'file_sertifikat' => str_replace('public/file_sertifikat/', '', $request->file('file_sertifikat')->store('public/file_sertifikat')),
        ]);

        $status_peserta = StatusPeserta::where('id_skema', $request->id_skema)->where('id_users', $request->id_user)->get()[0];

        try {
            $mail = Mail::send(new NotifikasiSertifikatMail([
                'email' => $status_peserta->user->email,
                'subject_' => 'Selamat, Anda telah lulus pada skema '.$status_peserta->skema->nama,
                'message_' => 'Selamat, Anda telah lulus pada skema '.$status_peserta->skema->nama.'. Silahkan login ke akun Anda untuk melihat sertifikat Anda.',
                'skema' => $status_peserta->skema->nama,
            ]));

            if ($mail) {
                LogEmail::create([
                    'hal' => 'notifikasi informasi sertifikat peserta email',
                    'email' => $status_peserta->user->email,
                    'status' => 'berhasil',
                ]);
            }
        } catch (\Throwable $th) {
            LogEmail::create([
                'hal' => 'notifikasi informasi sertifikat peserta email',
                'email' => $status_peserta->user->email,
                'status' => 'gagal',
            ]);
        }


        $notifikasi = new Notifikasi();

        $notifikasi->judul = 'Selamat, Anda telah lulus pada skema '.$status_peserta->skema->nama;
        $notifikasi->pesan = 'Selamat, Anda telah lulus pada skema '.$status_peserta->skema->nama.'. Silahkan login ke akun Anda untuk melihat sertifikat Anda.';
        $notifikasi->is_dibaca = 'tidak_dibaca';
        $notifikasi->id_users = $status_peserta->user->id_users;

        $notifikasi->save();

        return redirect()->route('sertifikat.index')->with('success', 'Data telah disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusPeserta $status_peserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_status_peserta)
    {
        return view('admin.sertifikat.edit', [
            'skemas' => Skema::all(),
            'status_peserta' => StatusPeserta::where('id_status_peserta', $id_status_peserta)->get()[0],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_status_peserta)
    {
        $validatedData = $request->validate([
            'id_skema' => 'required',
            'id_user' => 'required',
            'tanggal_penetapan' => 'required|date',
            'nomor_blanko' => 'required|string',
            'nomor_registrasi' => 'required|string',
            'file_sertifikat' => 'mimes:png,jpg,jpegpdf,doc,docx',
        ]);

        if ($request->file('file_sertifikat') != null) {
            StatusPeserta::where('id_skema', $request->id_skema)->where('id_users', $request->id_user)->update([
                'nomor_blanko' => $request->nomor_blanko,
                'nomor_registrasi' => $request->nomor_registrasi,
                'tanggal_penetapan' => $request->tanggal_penetapan,
                'tanggal_surveilan' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addYears(1),
                'tanggal_notif_expired' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addMonths(33),
                'tanggal_expired' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addYears(3),
                'file_sertifikat' => str_replace('public/file_sertifikat/', '', $request->file('file_sertifikat')->store('public/file_sertifikat')),
            ]);
        } else {
            StatusPeserta::where('id_skema', $request->id_skema)->where('id_users', $request->id_user)->update([
                'nomor_blanko' => $request->nomor_blanko,
                'nomor_registrasi' => $request->nomor_registrasi,
                'tanggal_penetapan' => $request->tanggal_penetapan,
                'tanggal_surveilan' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addYears(1),
                'tanggal_notif_expired' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addMonths(33),
                'tanggal_expired' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addYears(3),
            ]);
        }

        return redirect()->route('sertifikat.index')->with('success', 'Data telah disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_status_peserta)
    {
        StatusPeserta::where('id_status_peserta', $id_status_peserta)->update([
            'nomor_blanko' => null,
            'nomor_registrasi' => null,
            'tanggal_penetapan' => null,
            'tanggal_surveilan' => null,
            'tanggal_notif_expired' => null,
            'tanggal_expired' => null,
            'file_sertifikat' => null,
        ]);

        return redirect()->route('sertifikat.index')->with('success', 'Data telah dihapus');
    }

    public function getUsersByScheme($id_skema)
    {
        $skema = Skema::findOrFail($id_skema);
        $users = $skema->status_peserta()->where('status', 'lulus')->where('file_sertifikat', null)->get();

        $view = view('layouts.user_by_skema', compact('users'))->render();

        return response()->json(['users' => $users]);
    }
}
