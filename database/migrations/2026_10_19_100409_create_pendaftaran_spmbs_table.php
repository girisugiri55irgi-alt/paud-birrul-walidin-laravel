<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran_spmb', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_pendaftaran')->unique();
            $table->string('token_bukti', 64)->unique();

            // Data calon murid
            $table->string('nama_calon');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin', 20);
            $table->text('alamat');

            // Data orang tua atau wali
            $table->string('nama_orang_tua');
            $table->string('no_hp', 20);
            $table->string('email')->nullable();

            // Status seleksi
            $table->string('status')->default('menunggu');
            $table->text('catatan_seleksi')->nullable();
            $table->timestamp('tanggal_diumumkan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_spmb');
    }
};
