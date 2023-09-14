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

            $table->enum('is_disetujui', ['disetujui', 'tidak_disetujui', 'pending', 'revisi', 'menunggu_pending'])->default('pending');
            $table->text('catatan')->nullable();

            $table->string('file_syarat_ijazah_terakhir')->nullable();
            $table->enum('status_file_syarat_ijazah_terakhir', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_sertifikat_pelatihan')->nullable();
            $table->enum('status_file_syarat_sertifikat_pelatihan', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_sk_penempatan')->nullable();
            $table->enum('status_file_syarat_sk_penempatan', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_sk_bebas_narkoba')->nullable();
            $table->enum('status_file_syarat_sk_bebas_narkoba', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_sk_sehat')->nullable();
            $table->enum('status_file_syarat_sk_sehat', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_surat_rekomendasi_satker')->nullable();
            $table->enum('status_file_syarat_surat_rekomendasi_satker', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_nilai_e_rohani')->nullable();
            $table->enum('status_file_syarat_nilai_e_rohani', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_smk_skp_terakhir')->nullable();
            $table->enum('status_file_syarat_smk_skp_terakhir', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_cv')->nullable();
            $table->enum('status_file_syarat_cv', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_pas_photo')->nullable();
            $table->enum('status_file_syarat_pas_photo', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_sertifikat_keahlian_khusus')->nullable();
            $table->enum('status_file_syarat_sertifikat_keahlian_khusus', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_nilai_smk')->nullable();
            $table->enum('status_file_syarat_nilai_smk', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_keputusan_penyidik')->nullable();
            $table->enum('status_file_syarat_keputusan_penyidik', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_skhp')->nullable();
            $table->enum('status_file_syarat_skhp', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_dokumen_lainnya')->nullable();
            $table->enum('status_file_syarat_dokumen_lainnya', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->string('file_syarat_logbook')->nullable();
            $table->enum('status_file_syarat_logbook', ['ada disetujui', 'ada tidak disetujui', 'tidak ada'])->nullable();

            $table->unsignedInteger('id_users')->nullable();
            $table->foreign('id_users')->references('id_users')->on('users');
            $table->unsignedInteger('id_skema')->nullable();
            $table->foreign('id_skema')->references('id_skema')->on('skema');
            $table->unsignedInteger('id_tuk')->nullable();
            $table->foreign('id_tuk')->references('id_tuk')->on('tuk');

            $table->enum('jenis_pengajuan', ['baru', 'perpanjang'])->default('baru');

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