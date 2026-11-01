<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id',
        'user_id',
        'siswa_id',
        'jawaban',
        'file_jawaban',
        'status',
        'catatan_pendidik',
        'dikumpulkan_pada',
    ];

    protected function casts(): array
    {
        return [
            'dikumpulkan_pada' => 'datetime',
        ];
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}