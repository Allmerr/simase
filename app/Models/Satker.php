<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    use HasFactory;

    protected $guarded = 'id_satker';

    protected $table = 'satker';

    protected $primaryKey = 'id_satker';
}
