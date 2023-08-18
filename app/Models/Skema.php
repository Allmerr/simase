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
}
