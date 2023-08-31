<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotaKabupaten extends Model
{
    use HasFactory;

    protected $guarded = 'id_kota_kabupaten';
    protected $table = 'kota_kabupaten';
    protected $primaryKey = 'id_kota_kabupaten';
}