<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    protected $table = 'galeri_fotos';

    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'is_published',
        'urutan',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'urutan' => 'integer',
        ];
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}