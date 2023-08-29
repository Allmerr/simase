<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = 'id_survey';
    protected $table = 'survey';
    protected $primaryKey = 'id_survey';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function skema()
    {
        return $this->belongsTo(Skema::class, 'id_skema', 'id_skema');
    }
}