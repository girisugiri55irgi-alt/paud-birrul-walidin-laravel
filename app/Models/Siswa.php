<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Evaluasi;

class Siswa extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'kelas',
        'nama_orang_tua',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function evaluasis(): HasMany
    {
        return $this->hasMany(Evaluasi::class);
    }

    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
