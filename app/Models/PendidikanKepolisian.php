<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanKepolisian extends Model
{
    use HasFactory;

    protected $guarded = 'id_pendidikan_kepolisian';
    protected $table = 'pendidikan_kepolisian';
    protected $primaryKey = 'id_pendidikan_kepolisian';
}