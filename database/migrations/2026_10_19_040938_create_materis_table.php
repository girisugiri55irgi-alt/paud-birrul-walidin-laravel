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
    Schema::create('materis', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('tema')->nullable();
        $table->string('kelompok_usia')->nullable();
        $table->text('deskripsi')->nullable();
        $table->longText('isi_materi')->nullable();
        $table->string('file_materi')->nullable();
        $table->string('jenis_file')->nullable();
        $table->foreignId('user_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
