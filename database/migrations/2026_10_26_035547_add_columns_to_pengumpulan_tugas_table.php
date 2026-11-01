<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->unsignedBigInteger('tugas_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('siswa_id')->nullable();

            $table->text('jawaban')->nullable();
            $table->string('file_jawaban')->nullable();
            $table->string('status')->default('menunggu');
            $table->text('catatan_pendidik')->nullable();
            $table->timestamp('dikumpulkan_pada')->nullable();

            $table->foreign('tugas_id')
                ->references('id')->on('tugas')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->foreign('siswa_id')
                ->references('id')->on('siswas')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->dropForeign(['tugas_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['siswa_id']);

            $table->dropColumn([
                'tugas_id',
                'user_id',
                'siswa_id',
                'jawaban',
                'file_jawaban',
                'status',
                'catatan_pendidik',
                'dikumpulkan_pada',
            ]);
        });
    }
};