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
        Schema::create('survey', function (Blueprint $table) {
            $table->increments('id_survey');

            $table->string('nomor_blanko');
            $table->string('pekerjaan');
            $table->string('instansi');

            $table->unsignedInteger('id_skema');
            $table->foreign('id_skema')->references('id_skema')->on('skema')->onDelete('cascade');
            $table->unsignedInteger('id_users')->nullable();
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            
            $table->enum('keterangan', ['sesuai', 'tidak sesuai']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey');
    }
};