<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('status_pelapor')->nullable()->after('pjgt_user_id')->comment('Masyarakat/Lembaga/SPGT/Lainnya');
            $table->string('kontak_pelapor')->nullable()->after('status_pelapor');
            $table->string('nama_pelapor')->nullable()->after('kontak_pelapor');
            $table->string('nama_terlapor')->nullable()->after('gt_user_id');
            $table->string('tempat_tugas')->nullable()->after('nama_terlapor');
            $table->string('lokasi')->nullable()->after('tanggal_kejadian');
            $table->string('jenis_pelanggaran')->nullable()->after('lokasi')->comment('Ringan/Sedang/Berat');
            $table->text('kronologi')->nullable()->after('jenis_pelanggaran');
            $table->text('bukti_pendukung')->nullable()->after('kronologi');
            $table->text('tindak_lanjut')->nullable()->after('bukti_pendukung');
            $table->string('tempat_tanggal')->nullable()->after('tindak_lanjut');
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn(['status_pelapor','kontak_pelapor','nama_pelapor','nama_terlapor','tempat_tugas','lokasi','jenis_pelanggaran','kronologi','bukti_pendukung','tindak_lanjut','tempat_tanggal']);
        });
    }
};
