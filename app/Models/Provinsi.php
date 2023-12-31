<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $guarded = 'id_provinsi';

    protected $table = 'provinsi';

    protected $primaryKey = 'id_provinsi';
}
