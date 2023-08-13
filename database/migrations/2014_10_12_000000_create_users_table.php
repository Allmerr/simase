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
            $table->string('photo')->default('nopp.png');
            $table->enum('role', ['admin', 'peserta'])->default('peserta');
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