<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoKegiatan extends Model
{
    protected $table = 'video_kegiatans';

    protected $fillable = [
        'judul',
        'deskripsi',
        'url_video',
        'is_published',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}