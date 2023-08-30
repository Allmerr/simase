<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuk extends Model
{
    use HasFactory;

    protected $guarded = 'id_tuk';

    protected $table = 'tuk';

    protected $primaryKey = 'id_tuk';
}