<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materis';

    protected $fillable = [
        'judul',
        'tema',
        'kelompok_usia',
        'deskripsi',
        'isi_materi',
        'file_materi',
        'jenis_file',
        'user_id',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
