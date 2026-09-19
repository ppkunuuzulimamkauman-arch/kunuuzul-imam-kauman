<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gt_absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            // mengajar | shalat
            $table->string('jenis', 20);
            // Subuh/Dzuhur/Ashar/Maghrib/Isya — null untuk mengajar
            $table->string('shalat', 20)->nullable();
            // mengajar: Hadir/Izin/Sakit/Libur | shalat: Dicatat
            $table->string('status', 30)->default('Hadir');
            // shalat: Imam/Makmum — null untuk mengajar
            $table->string('peran', 20)->nullable();
            // shalat: Munfarid/Berjamaah — null untuk mengajar
            $table->string('cara', 20)->nullable();
            $table->string('keterangan', 500)->nullable();
            $table->string('jam', 10)->nullable();
            $table->timestamps();

            $table->index(['user_id', 'tanggal', 'jenis']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gt_absensis');
    }
};
