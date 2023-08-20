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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->increments('id_pengajuan');

            $table->enum('is_disetujui', ['disetujui', 'tidak_disetujui', 'pending', 'revisi']);
            $table->text('catatan')->nullable();

            $table->string('file_syarat_ktp');
            $table->enum('status_file_syarat_ktp', ['ada disetujui', 'ada tidak disetujui', 'tidak ada']);

            $table->string('file_syarat_kk');
            $table->enum('status_file_syarat_kk', ['ada disetujui', 'ada tidak disetujui', 'tidak ada']);

            $table->string('file_syarat_npwp');
            $table->enum('status_file_syarat_npwp', ['ada disetujui', 'ada tidak disetujui', 'tidak ada']);

            $table->unsignedInteger('id_users')->nullable();
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            $table->unsignedInteger('id_skema')->nullable();
            $table->foreign('id_skema')->references('id_skema')->on('skema')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};