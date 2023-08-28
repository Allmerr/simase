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
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('pendidikan_terakhir')->nullable();

            $table->text('dikbangspes')->nullable();
            $table->text('pelatihan_diikuti')->nullable();
            $table->text('keterampilan_khusus')->nullable();

            $table->unsignedInteger('id_satker')->nullable();
            $table->foreign('id_satker')->references('id_satker')->on('satker');
            $table->unsignedInteger('id_pangkat')->nullable();
            $table->foreign('id_pangkat')->references('id_pangkat')->on('pangkat');
            $table->unsignedInteger('id_pendidikan_kepolisian')->nullable();
            $table->foreign('id_pendidikan_kepolisian')->references('id_pendidikan_kepolisian')->on('pendidikan_kepolisian');

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