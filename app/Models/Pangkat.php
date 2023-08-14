<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;

    protected $guarded = 'id_pangkat';
    protected $table = 'pangkat';
    protected $primaryKey = 'id_pangkat';
}