<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;



class PeminjamanController extends Controller
{
  
    public function index()
    {
        // Inisialisasi tanggal saat ini
        $sekarang = Carbon::now();
    
        // Query peminjaman dengan filter status "Dipinjam" dan tanggal pengembalian kurang dari sekarang
        $peminjamans = Peminjaman::with('details')
            ->where('status', 'Dipinjam')
            ->where('tanggal_pengembalian', '<', $sekarang)
            ->get();
    
        // Hitung dan simpan denda untuk setiap peminjaman yang memenuhi kriteria
        foreach ($peminjamans as $pinjam) {
            // Panggil metode untuk menghitung denda
            $pinjam->hitungDenda();
            // Simpan perubahan pada peminjaman
            $pinjam->save();
        }
    
        // Ambil semua peminjaman dengan status "Dipinjam" untuk ditampilkan
        $peminjamans = Peminjaman::whereIn('status', ['Dipinjam', 'Lunas'])
        ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Kembalikan view dengan data peminjaman
        return view('peminjamans.index', compact('peminjamans'));
    }
    

public function returned()
{
    $peminjamans = Peminjaman::where('status', 'Dikembalikan')->with('user')->orderBy('created_at', 'desc')->get();
    return view('Pengembalian.index', compact('peminjamans'));
}
public function all(Request $request)
    {
        $sekarang = Carbon::now();

        // Ambil filter tanggal dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query peminjaman dengan filter tanggal
        $query = Peminjaman::with('details')
            ->where('status', 'Dipinjam')
            ->where('tanggal_pengembalian', '<', $sekarang);

        // Terapkan filter tanggal jika ada
        if ($startDate) {
            $query->whereDate('created_at', '>=', Carbon::parse($startDate)->startOfDay());
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', Carbon::parse($endDate)->endOfDay());
        }

        // Ambil data peminjaman yang sesuai dengan filter
        $peminjamans = $query->get();

        // Hitung dan simpan denda untuk setiap peminjaman yang memenuhi kriteria
        foreach ($peminjamans as $pinjam) {
            $pinjam->hitungDenda();
            $pinjam->save();
        }

        // Ambil semua peminjaman untuk ditampilkan di view
        $semuaPeminjamans = Peminjaman::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Kirim data ke view Laporan.index
        return view('Laporan.index', compact('semuaPeminjamans'));
    }

   




    public function create()
    {
        $bukus = Buku::all();
        $users = User::where('role_id', 2)->get(); // Assuming role_id 2 for borrowers
        return view('peminjamans.create', compact('bukus', 'users'));
    }


    public function updateStatus(Peminjaman $peminjaman)
{
    // Cek apakah denda masih ada
    if ($peminjaman->denda > 0) {
        return redirect()->route('peminjaman.index')->with('warning', 'Silakan bayar denda terlebih dahulu sebelum mengembalikan buku.');
    }

    // Perbarui status peminjaman menjadi 'Dikembalikan'
    $peminjaman->update([
        'status' => 'Dikembalikan',
    ]);

    // Tambahkan stok buku sesuai dengan jumlah yang dikembalikan
    foreach ($peminjaman->details as $detail) {
        $buku = Buku::find($detail->buku_id);
        if ($buku) {
            $buku->stok_tersedia += $detail->jumlah;
            $buku->save();
        }
    }

    return redirect()->route('peminjaman.index')->with('success', 'Status peminjaman telah diubah menjadi Dikembalikan dan stok buku diperbarui.');
}


    public function peminjaman()
    {
        $user = Auth::user();
        $peminjamans = Peminjaman::where('user_id', $user->id)
                                  ->whereIn('status', ['Dipinjam', 'Lunas'])
                                  ->with('user')
                                  ->orderBy('created_at', 'desc')
                                  ->get();
    
        return view('peminjamans.user_peminjaman', compact('peminjamans'));
    }
    


public function pengembalian()
{
    $user = Auth::user();
    $peminjamans = Peminjaman::where('user_id', $user->id)
                              ->where('status', 'Dikembalikan')
                              ->with(['user', 'details.buku'])
                              ->orderBy('created_at', 'desc')
                              ->get();
    return view('Pengembalian.Pengembalian_user', compact('peminjamans'));
}


public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'tanggal_pengembalian' => 'nullable|date',
        'books' => 'required|array',
        'books.*.id' => 'required|exists:bukus,id',
        'books.*.jumlah' => 'required|integer|min:1',
    ]);

    // Cek apakah pengguna memiliki denda yang belum dibayar
    $user = User::find($request->user_id);
    $hasOutstandingFine = $user->peminjaman()->where('status', 'Dipinjam')->where('denda', '>', 0)->exists();

    if ($hasOutstandingFine) {
        return redirect()->back()->withErrors(['error' => 'Anda tidak dapat melakukan peminjaman baru karena memiliki denda yang belum dibayar.']);
    }

    // Cek apakah pengguna sudah meminjam buku yang sama dan belum mengembalikannya
    foreach ($request->books as $book) {
        $buku = Buku::find($book['id']);
        $hasBorrowed = $user->peminjaman()
                            ->where('status', 'Dipinjam')
                            ->whereHas('details', function($query) use ($book) {
                                $query->where('buku_id', $book['id']);
                            })->exists();

        if ($hasBorrowed) {
            return redirect()->back()->withErrors(['error' => "Anda sudah meminjam buku {$buku->judul} dan belum mengembalikannya. Harap kembalikan buku terlebih dahulu sebelum meminjam kembali."]);
        }

        // Cek ketersediaan stok buku
        if ($buku->stok_tersedia < $book['jumlah']) {
            return redirect()->back()->withErrors(['error' => "Stok untuk buku {$buku->judul} tidak mencukupi. Stok tersedia: {$buku->stok_tersedia}"]);
        }
    }

    // Buat peminjaman baru
    $peminjaman = Peminjaman::create([
        'user_id' => $request->user_id,
        'tanggal_pengembalian' => $request->tanggal_pengembalian,
        'status' => 'Dipinjam', // Set status default
    ]);

    // Simpan detail peminjaman dan kurangi stok buku
    foreach ($request->books as $book) {
        $buku = Buku::find($book['id']);
        $peminjaman->details()->create([
            'buku_id' => $book['id'],
            'jumlah' => $book['jumlah'],
        ]);

        // Kurangi stok buku
        $buku->stok_tersedia -= $book['jumlah'];
        $buku->save();
    }

    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dibuat.');
}


    
    public function edit(Peminjaman $peminjaman)
    {
        $bukus = Buku::all();
        $users = User::where('role_id', 2)->get(); // Assuming role_id 2 for borrowers
        return view('peminjamans.edit', compact('peminjaman', 'bukus', 'users'));
    }



    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->details()->delete();
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function show($id)
{
    $peminjaman = Peminjaman::with('details.buku')->findOrFail($id);
    return view('peminjamans.show', compact('peminjaman'));
}

}
