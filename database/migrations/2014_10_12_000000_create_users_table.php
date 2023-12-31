<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id_users');
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telpon');
            $table->enum('role', ['admin', 'peserta'])->default('peserta');

            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->string('nip')->nullable();
            $table->string('nik')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();

            $table->unsignedInteger('kode_provinsi')->nullable();
            $table->foreign('kode_provinsi')->references('kode_provinsi')->on('provinsi')->onDelete('cascade');
            $table->unsignedInteger('kode_kota_kabupaten')->nullable();
            $table->foreign('kode_kota_kabupaten')->references('kode_kota_kabupaten')->on('kota_kabupaten')->onDelete('cascade');
            $table->unsignedInteger('kode_pendidikan')->nullable();
            $table->foreign('kode_pendidikan')->references('kode_pendidikan')->on('pendidikan')->onDelete('cascade');
            $table->unsignedInteger('kode_pekerjaan')->nullable();
            $table->foreign('kode_pekerjaan')->references('kode_pekerjaan')->on('pekerjaan')->onDelete('cascade');

            $table->text('dikbangspes')->nullable();
            $table->text('pelatihan_diikuti')->nullable();
            $table->text('keterampilan_khusus')->nullable();

            $table->unsignedInteger('id_satker')->nullable();
            $table->foreign('id_satker')->references('id_satker')->on('satker')->onDelete('cascade');
            $table->unsignedInteger('id_pangkat')->nullable();
            $table->foreign('id_pangkat')->references('id_pangkat')->on('pangkat')->onDelete('cascade');
            $table->unsignedInteger('id_pendidikan_kepolisian')->nullable();
            $table->foreign('id_pendidikan_kepolisian')->references('id_pendidikan_kepolisian')->on('pendidikan_kepolisian')->onDelete('cascade');

            $table->string('photo')->default('nopp.png');

            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
