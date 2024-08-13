<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PeminjamanKelas extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_kelas';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'jumlah_buku'
    ];

    protected $dates = ['tanggal_pinjam', 'tanggal_kembali'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hitungDenda()
    {
        // Hitung denda jika status adalah "Dipinjam" dan tanggal pengembalian sudah lewat
        if ($this->status == 'Dipinjam' && $this->tanggal_kembali && $this->tanggal_kembali < Carbon::now()) {
            $hariTerlambat = Carbon::now()->diffInDays($this->tanggal_kembali);
            $denda = $hariTerlambat * 2000 * $this->jumlah_buku;
            return $denda;
        }
        return 0;
    }
}
