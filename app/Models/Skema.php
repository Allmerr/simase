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
}