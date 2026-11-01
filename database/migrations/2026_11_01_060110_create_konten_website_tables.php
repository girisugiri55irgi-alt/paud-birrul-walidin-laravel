<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // GALERI FOTO
        Schema::create('galeri_fotos', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('foto');
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('urutan')->default(0);
            $table->foreignId('user_id')->nullable()
                ->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // VIDEO KEGIATAN
        Schema::create('video_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('url_video');
            $table->boolean('is_published')->default(false);
            $table->foreignId('user_id')->nullable()
                ->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // INFORMASI DAN PENGUMUMAN
        Schema::create('informasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->longText('isi');
            $table->string('gambar')->nullable();
            $table->dateTime('tanggal_publikasi')->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignId('user_id')->nullable()
                ->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // AGENDA SEKOLAH
        Schema::create('agenda_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->boolean('is_published')->default(false);
            $table->foreignId('user_id')->nullable()
                ->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agenda_sekolahs');
        Schema::dropIfExists('informasis');
        Schema::dropIfExists('video_kegiatans');
        Schema::dropIfExists('galeri_fotos');
    }
};