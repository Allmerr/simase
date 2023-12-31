<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPeserta extends Model
{
    use HasFactory;

    protected $guarded = 'id_status_peserta';

    protected $table = 'status_peserta';

    protected $primaryKey = 'id_status_peserta';

    public function skema()
    {
        return $this->belongsTo(Skema::class, 'id_skema', 'id_skema');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function hasSurveyPassed()
    {
        return $this->tanggal_surveilan <= now();
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'id_status_peserta', 'id_status_peserta');
    }
}
