<?php

namespace App\Observers;

use App\Models\Notifikasi;
use App\Models\Pengajuan;

class NotifikasiPengajuanObserver
{
    /**
     * Handle the Pengajuan "created" event.
     */
    public function created(Pengajuan $pengajuan): void
    {
        $notifikasi = new Notifikasi();

        $notifikasi->judul = 'Pendaftaraan anda, pada skema '.$pengajuan->skema->nama;
        $notifikasi->pesan = 'Pendaftaraan anda, pada skema '.$pengajuan->skema->nama.' sudah berhasil direkam, dan sedang dalam pemerikasaan admin, nantikan notifikasi terbaru.';
        $notifikasi->is_dibaca = 'tidak_dibaca';
        $notifikasi->id_users = $pengajuan->id_users;

        $notifikasi->save();
    }

    /**
     * Handle the Pengajuan "updated" event.
     */
    public function updated(Pengajuan $pengajuan): void
    {

        $notifikasi = new Notifikasi();

        $notifikasi->judul = 'Pendaftaraan anda, pada skema '.$pengajuan->skema->nama;
        $notifikasi->pesan = 'Pendaftaran anda, pada skema ' . $pengajuan->skema->nama . 'telah ' . $pengajuan->is_disetujui . 'oleh admin, nantikan notifikasi terbaru.';
        $notifikasi->is_dibaca = 'tidak_dibaca';
        $notifikasi->id_users = $pengajuan->id_users;

        $notifikasi->save();
    }

    /**
     * Handle the Pengajuan "deleted" event.
     */
    public function deleted(Pengajuan $pengajuan): void
    {
        //
    }

    /**
     * Handle the Pengajuan "restored" event.
     */
    public function restored(Pengajuan $pengajuan): void
    {
        //
    }

    /**
     * Handle the Pengajuan "force deleted" event.
     */
    public function forceDeleted(Pengajuan $pengajuan): void
    {
        //
    }
}