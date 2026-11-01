<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasis';

    protected $fillable = [
        'judul',
        'isi',
        'gambar',
        'tanggal_publikasi',
        'is_published',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_publikasi' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}