<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Peminjaman extends Model
{
    protected $table = 'peminjaman'; // Pastikan ini sesuai dengan nama tabel di database

    protected $dates = ['tanggal_pengembalian']; // Laravel otomatis konversi ini ke Carbon

    protected $fillable = [
        'user_id',
        'tanggal_pengembalian',
        'status', // Tambahkan kolom ini
        'denda' // Pastikan kolom denda ada di tabel
    ];

    public function details()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hitungDenda()
    {
        // Pastikan tanggal_pengembalian adalah objek Carbon
        $tanggalPengembalian = Carbon::parse($this->tanggal_pengembalian);

        // Hitung denda hanya jika status adalah "Dipinjam" dan tanggal pengembalian sudah lewat
        if ($this->status == 'Dipinjam' && $tanggalPengembalian->isPast()) {
            $hariTerlambat = $tanggalPengembalian->diffInDays(Carbon::now());

            // Ambil jumlah dari setiap detail yang terkait dengan peminjaman ini
            $jumlahBuku = $this->details->sum('jumlah');

            // Hitung denda
            $denda = $hariTerlambat * 2000 * $jumlahBuku;
            $this->denda = $denda;
        } else {
            $this->denda = 0;
        }
    }
}
