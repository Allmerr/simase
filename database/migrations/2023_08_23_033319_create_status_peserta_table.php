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
        Schema::create('status_peserta', function (Blueprint $table) {
            $table->increments('id_status_peserta');

            $table->enum('status', ['diterima', 'lulus', 'expired', 'tidak-lulus'])->default('diterima');
            $table->string('file_sertifikat')->nullable();

            $table->string('nomor_blanko')->nullable();
            $table->string('nomor_registrasi')->nullable();
            $table->date('tanggal_penetapan')->nullable();
            $table->date('tanggal_surveilan')->nullable();
            $table->date('tanggal_notif_expired')->nullable();
            $table->date('tanggal_expired')->nullable();

            $table->enum('sudah_servey', ['sudah', 'belum'])->default('belum');
            $table->enum('sudah_kirim_notif', ['sudah', 'belum'])->default('belum');

            $table->unsignedInteger('id_skema')->nullable();
            $table->foreign('id_skema')->references('id_skema')->on('skema')->onDelete('cascade');
            $table->unsignedInteger('id_users')->nullable();
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_peserta');
    }
};
