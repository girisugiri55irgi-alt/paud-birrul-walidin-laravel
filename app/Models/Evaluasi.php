<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluasi extends Model
{
    protected $fillable = [
        'siswa_id',
        'tahun_ajaran_id',
        'tanggal_penilaian',
        'agama_moral',
        'kognitif',
        'motorik',
        'sosial_emosional',
        'catatan_guru',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_penilaian' => 'date',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}