<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penempatans', function (Blueprint $table) {
            $table->id();
            // 1 GT = 1 lembaga aktif (pindah = update)
            $table->foreignId('gt_user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->foreignId('permohonan_id')->constrained('permohonans')->cascadeOnDelete();
            $table->string('catatan', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penempatans');
    }
};
