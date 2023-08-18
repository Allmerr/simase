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

            $table->string('dokumen_persyaratan');
            $table->enum('is_disetujui', ['disetujui', 'tidak_disetujui', 'pending', 'revision']);
            $table->text('catatan')->nullable();

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
