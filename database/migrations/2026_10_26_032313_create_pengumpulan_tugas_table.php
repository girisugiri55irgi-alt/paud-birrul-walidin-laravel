<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumpulan_tugas', function (Blueprint $table) {
            $table->id();

            // Tugas pembelajaran yang dikumpulkan
            $table->foreignId('tugas_id')
                ->constrained('tugas')
                ->cascadeOnDelete();

            // Akun orang tua yang mengirimkan tugas
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Siswa yang mengerjakan tugas
            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->text('jawaban')->nullable();
            $table->string('file_jawaban')->nullable();

            // menunggu, diperiksa, atau perlu_perbaikan
            $table->string('status')->default('menunggu');

            $table->text('catatan_pendidik')->nullable();
            $table->timestamp('dikumpulkan_pada')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};