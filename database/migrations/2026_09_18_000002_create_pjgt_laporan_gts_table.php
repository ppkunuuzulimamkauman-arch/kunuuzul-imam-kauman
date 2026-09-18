<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pjgt_laporan_gts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pjgt_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('gt_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('tahun_ajaran')->default('1448/1449');
            $table->string('bulan')->comment('1-12 atau Januari-Desember');
            $table->string('periode')->comment('YYYY-MM');
            $table->string('nama_madrasah')->nullable();
            // Madrasiyah 6 indikator: nilai sangat baik/baik/kurang + catatan
            $table->json('madrasiyah')->nullable();
            // Kemasyarakatan 5 indikator
            $table->json('kemasyarakatan')->nullable();
            $table->text('catatan_umum')->nullable();
            $table->string('status')->default('Terkirim');
            $table->timestamps();
            $table->unique(['pjgt_user_id', 'gt_user_id', 'periode'], 'uniq_pjgt_gt_periode');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pjgt_laporan_gts');
    }
};
