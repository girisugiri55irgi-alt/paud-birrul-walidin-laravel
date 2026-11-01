<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaSekolah extends Model
{
    protected $table = 'agenda_sekolahs';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'is_published',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}