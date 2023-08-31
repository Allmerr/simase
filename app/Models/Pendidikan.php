<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $guarded = 'id_pendidikan';
    protected $table = 'pendidikan';
    protected $primaryKey = 'id_pendidikan';
}