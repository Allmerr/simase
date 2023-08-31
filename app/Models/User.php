<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'no_telpon',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'id_satker', 'id_satker');
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat', 'id_pangkat');
    }

    public function pendidikan_kepolisian()
    {
        return $this->belongsTo(PendidikanKepolisian::class, 'id_pendidikan_kepolisian', 'id_pendidikan_kepolisian');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_users', 'id_users');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_users', 'id_users');
    }

    public function status_peserta()
    {
        return $this->hasMany(StatusPeserta::class, 'id_users', 'id_users');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'kode_provinsi', 'kode_provinsi');
    }

    public function kota_kabupaten()
    {
        return $this->belongsTo(KotaKabupaten::class, 'kode_kota_kabupaten', 'kode_kota_kabupaten');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'kode_pendidikan', 'kode_pendidikan');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'kode_pekerjaan', 'kode_pekerjaan');
    }
}