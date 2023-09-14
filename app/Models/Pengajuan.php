<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $guarded = 'id_pengajuan';

    protected $table = 'pengajuan';

    protected $primaryKey = 'id_pengajuan';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function skema()
    {
        return $this->belongsTo(Skema::class, 'id_skema', 'id_skema');
    }

    public function status_peserta()
    {
        return $this->belongsTo(StatusPeserta::class, 'id_users', 'id_users');
    }

    public function tuk()
    {
        return $this->belongsTo(Tuk::class, 'id_tuk', 'id_tuk');
    }
}
