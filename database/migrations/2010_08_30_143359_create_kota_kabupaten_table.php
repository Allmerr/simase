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
        Schema::create('kota_kabupaten', function (Blueprint $table) {
            $table->increments('id_kota_kabupaten');

            $table->unsignedInteger('kode_provinsi')->nullable();
            $table->foreign('kode_provinsi')->references('kode_provinsi')->on('provinsi');

            $table->unsignedInteger('kode_kota_kabupaten')->index()->unique();
            $table->string('nama_kota_kabupaten');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kota_kabupaten');
    }
};
