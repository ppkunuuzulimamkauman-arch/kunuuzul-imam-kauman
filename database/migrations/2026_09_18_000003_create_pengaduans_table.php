<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pjgt_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('gt_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nama_madrasah')->nullable();
            $table->string('judul')->comment('ringkasan pengaduan');
            $table->string('kategori')->default('Kesalahan')->comment('Kesalahan, Pelanggaran, Kedisiplinan, Lainnya');
            $table->text('deskripsi')->comment('apa yang dilakukan GT termasuk kesalahan dll');
            $table->date('tanggal_kejadian')->nullable();
            $table->string('status')->default('Menunggu')->comment('Menunggu, Ditindaklanjuti, Selesai, Ditolak');
            $table->text('tanggapan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
