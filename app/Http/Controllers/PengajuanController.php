<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiPesertaAccPengajuanMail;

use App\Models\Pengajuan;
use App\Models\Skema;
use App\Models\User;
use Illuminate\Http\Request;

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

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil mendaftar skema, silahkan tunggu konfirmasi dari admin melalui email anda!');

    }

    public function tolak(Request $request, $id_pengajuan)
    {
        Pengajuan::where('id_pengajuan', $id_pengajuan)->update([
            'is_disetujui' => 'tidak_disetujui',
        ]);

        $pengajuan = Pengajuan::find($id_pengajuan);

        $this->sendEmail($pengajuan->id_users, $pengajuan->id_skema, $pengajuan->is_disetujui);

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil mendaftar skema, silahkan tunggu konfirmasi dari admin melalui email anda!');

    }

    public function revisi(Request $request, $id_pengajuan)
    {
        Pengajuan::where('id_pengajuan', $id_pengajuan)->update([
            'is_disetujui' => 'revisi',
        ]);

        $pengajuan = Pengajuan::find($id_pengajuan);

        $this->sendEmail($pengajuan->id_users, $pengajuan->id_skema, $pengajuan->is_disetujui);

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

}