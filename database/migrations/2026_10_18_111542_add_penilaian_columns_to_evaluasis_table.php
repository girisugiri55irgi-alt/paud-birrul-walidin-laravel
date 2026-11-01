
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('evaluasis', function (Blueprint $table) {
            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->foreignId('tahun_ajaran_id')
                ->constrained('tahun_ajarans')
                ->cascadeOnDelete();

            $table->date('tanggal_penilaian')->nullable();

            $table->text('agama_moral')->nullable();
            $table->text('kognitif')->nullable();
            $table->text('motorik')->nullable();
            $table->text('sosial_emosional')->nullable();
            $table->text('catatan_guru')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('evaluasis', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['tahun_ajaran_id']);

            $table->dropColumn([
                'siswa_id',
                'tahun_ajaran_id',
                'tanggal_penilaian',
                'agama_moral',
                'kognitif',
                'motorik',
                'sosial_emosional',
                'catatan_guru',
            ]);
        });
    }
};
