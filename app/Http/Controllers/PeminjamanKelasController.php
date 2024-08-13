<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanKelas;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanKelasController extends Controller
{
    // Menampilkan daftar semua peminjaman kelas
    public function index()
    {
        $peminjamanKelas = PeminjamanKelas::with('user', 'buku')->get();
        return view('peminjaman_kelas.index', compact('peminjamanKelas'));
    }

    // Menampilkan form untuk membuat peminjaman kelas baru
   
    public function create()
{
    $buku = Buku::all();
    $user = User::where('role_id', 2)->get(); // Memastikan hanya pengguna dengan role_id 2 yang dipilih
    return view('peminjaman_kelas.create', compact('buku', 'user'));
}

    // Menyimpan peminjaman kelas yang baru dibuat
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id', // Pastikan nama tabel 'bukus'
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'jumlah_buku' => 'required|integer|min:1'
        ]);

        // Periksa apakah kelas sudah memiliki peminjaman yang belum dikembalikan
        $user = User::find($request->input('user_id'));
        $peminjamanAktif = PeminjamanKelas::where('user_id', $user->id)
            ->where('status', 'Dipinjam')
            ->exists();

        if ($peminjamanAktif) {
            return redirect()->back()->withErrors(['user_id' => 'Kelas ini masih memiliki peminjaman yang belum dikembalikan.']);
        }

        PeminjamanKelas::create($request->all());
        $user->update(['status_peminjam' => 'Pinjam']); // Update status peminjam menjadi Pinjam

        return redirect()->route('peminjaman_kelas.index')->with('success', 'Peminjaman berhasil dibuat.');
    }

    // Menampilkan detail peminjaman kelas
    public function show(PeminjamanKelas $peminjamanKelas)
    {
        return view('peminjaman_kelas.show', compact('peminjamanKelas'));
    }

    // Menampilkan form untuk mengedit peminjaman kelas
    public function edit(PeminjamanKelas $peminjamanKelas)
    {
        $buku = Buku::all(); // Mengambil semua data buku
        $user = User::where('role_id', 2)->get(); // Mengambil pengguna dengan role_id 2 dan status peminjam 'Belum Pinjam'
        return view('peminjaman_kelas.edit', compact('peminjamanKelas', 'buku', 'user'));
    }

    // Memperbarui peminjaman kelas
    public function update(Request $request, PeminjamanKelas $peminjamanKelas)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id', // Pastikan nama tabel 'bukus'
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'jumlah_buku' => 'required|integer|min:1'
        ]);

        $peminjamanKelas->update($request->all());
        return redirect()->route('peminjaman_kelas.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    // Menghapus peminjaman kelas
    public function destroy(PeminjamanKelas $peminjamanKelas)
    {
        $user = $peminjamanKelas->user;
        $peminjamanKelas->delete();
        $user->update(['status_peminjam' => 'Belum Pinjam']); // Update status peminjam menjadi Belum Pinjam

        return redirect()->route('peminjaman_kelas.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
