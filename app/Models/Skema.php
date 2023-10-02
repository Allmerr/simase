<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    protected $table = 'skema';

    protected $guarded = 'id_skema';

    protected $primaryKey = 'id_skema';

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_skema', 'id_skema');
    }

    public function peserta()
    {
        return $this->hasManyThrough(User::class, Pengajuan::class, 'id_skema', 'id_users');
    }

    public function status_peserta()
    {
        return $this->hasMany(StatusPeserta::class, 'id_skema', 'id_skema');
    }

    public function hasPendingApplication()
    {
        return auth()->user()->pengajuan()->where('id_skema', $this->id_skema)->where('is_disetujui', 'pending')->exists();
    }

    public function hasRejectedApplication()
    {
        return auth()->user()->pengajuan()->where('id_skema', $this->id_skema)->where('is_disetujui', 'tidak_disetujui')->exists();
    }

    public function hasPendingRevisionApplication()
    {
        return auth()->user()->pengajuan()->where('id_skema', $this->id_skema)->where('is_disetujui', 'pending')->exists();
    }

    public function hasRevisionApplication()
    {
        return auth()->user()->pengajuan()->where('id_skema', $this->id_skema)->where('is_disetujui', 'revisi')->exists();
    }

    public function hasApprovedAndPassed()
    {
        return auth()->user()->pengajuan()->where('id_skema', $this->id_skema)->where('is_disetujui', 'disetujui')->exists() && $this->status_peserta()->where('id_skema', $this->id_skema)->where('status', 'lulus')->where('id_users', auth()->user()->id_users)->exists();
    }

    public function hasApprovedAndNotPassedYet()
    {
        return auth()->user()->pengajuan()->where('id_skema', $this->id_skema)->where('is_disetujui', 'disetujui')->exists() && $this->status_peserta()->where('id_skema', $this->id_skema)->where('status', 'diterima')->where('id_users', auth()->user()->id_users)->exists();
    }

    public function getLastApplicationStatus()
    {
        $lastApplication = auth()->user()->pengajuan()
            ->where('id_skema', $this->id_skema)
            ->orderBy('created_at', 'desc')
            ->first();

        if (! $lastApplication) {
            return null; // No application found
        }

        return $lastApplication->is_disetujui;
    }
}