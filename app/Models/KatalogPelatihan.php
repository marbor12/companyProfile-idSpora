<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KatalogPelatihan extends Model
{
    use HasFactory;

    protected $table = 'katalog_pelatihans';

    protected $fillable = [
        'nama_pelatihan',
        'deskripsi',
        'tipe_pelatihan', // berbayar, free, khusus
        'kategori_materi', // IT & Programming, Digital Marketing, etc
        'harga',
        'instructor',
        'tanggal_pelatihan',
        'materi',
        'is_active',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'is_active' => 'boolean',
        'tanggal_pelatihan' => 'date',
    ];
}
