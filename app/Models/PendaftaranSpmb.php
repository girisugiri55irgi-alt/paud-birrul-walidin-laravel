<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranSpmb extends Model
{
    protected $table = 'pendaftaran_spmb';

    protected $fillable = [
        'nomor_pendaftaran',
        'token_bukti',
        'nama_calon',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nama_orang_tua',
        'no_hp',
        'email',
        'status',
        'catatan_seleksi',
        'tanggal_diumumkan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_diumumkan' => 'datetime',
    ];
}
