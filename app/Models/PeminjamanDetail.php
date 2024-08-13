<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_details'; // Pastikan ini sesuai dengan nama tabel di database


    protected $fillable = ['peminjaman_id', 'buku_id', 'jumlah'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
