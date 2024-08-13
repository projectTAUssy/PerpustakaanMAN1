<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus'; // Perbarui nama tabel sesuai dengan nama tabel di database

    protected $fillable = [
        'nomor_rak',
        'nama_rak',
        'judul',
        'pengarang',
        'tahun_terbit',
        'jenis_buku',
        'stok_tersedia',
        'keterangan',
        'foto_sampul',
        'file_buku',
    ];

    public function rakBuku()
    {
        return $this->belongsTo(RakBuku::class, 'nomor_rak', 'nomor_rak')->where('nama_rak', 'nama_rak');
    }
}
