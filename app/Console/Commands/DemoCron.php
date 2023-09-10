<?php

namespace App\Console\Commands;
use App\Models\StatusPeserta;
use App\Mail\NotifikasiExpiredMail;
use Illuminate\Support\Facades\Mail;


use Illuminate\Console\Command;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // kalau tanggal_notif_expired hari ini, maka kirim notif

        $statusPeserta = StatusPeserta::where('tanggal_notif_expired', date('Y-m-d'))->get();

        foreach ($statusPeserta as $key => $value) {
            if($statusPeserta[$key]->sudah_kirim_notif == 'sudah') continue;
            // kirim email

            Mail::send(new NotifikasiExpiredMail([
                'email' => $statusPeserta[$key]->user->email,
                'subject_' => 'Notifikasi expired sertifikat Anda pada skema ' . $statusPeserta[$key]->skema->nama,
                'message_' => 'Masa berlaku sertifikat Anda pada skema ' . $statusPeserta[$key]->skema->nama . ' tersisa tiga bulan. login ke akun Anda untuk memperpanjang masa berlaku sertifikat Anda.',
                'skema' => $statusPeserta[$key]->skema->nama,
            ]));

            $statusPeserta[$key]->sudah_kirim_notif = 'sudah';
            $statusPeserta[$key]->save();
        }

        // kalau tanggal_expired hari ini, maka ubah status menjadi expired
        $statusPeserta = StatusPeserta::where('tanggal_expired', date('Y-m-d'))->get();

        foreach ($statusPeserta as $key => $value) {
            if($statusPeserta[$key]->status == 'expired') continue;
            // ubah status

            $statusPeserta[$key]->status = 'expired';
            $statusPeserta[$key]->save();
        }
    }
}