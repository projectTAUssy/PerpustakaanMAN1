<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

class DendaController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $user = Auth::user();
        
        // Ambil semua peminjaman dengan status "Dipinjam" untuk pengguna yang sedang login
        $peminjamans = Peminjaman::where('user_id', $user->id)
                                  ->where('status', 'Dipinjam')
                                  ->orderBy('created_at', 'desc')
                                  ->get();
    
        // Hitung denda untuk setiap peminjaman
        foreach ($peminjamans as $peminjaman) {
            // Pastikan metode hitungDenda() sudah didefinisikan di model Peminjaman
            $peminjaman->hitungDenda();
            $peminjaman->denda = (int) $peminjaman->denda; // Pastikan denda adalah integer
            $peminjaman->save(); // Simpan denda yang telah dihitung
        }
    
        // Filter peminjaman yang memiliki denda lebih dari 0
        $peminjamans = $peminjamans->filter(function ($peminjaman) {
            return $peminjaman->denda > 0;
        });
    
        return view('denda.index', compact('peminjamans'));
    }
    

    public function pay(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|integer|exists:peminjaman,id',
            'amount' => 'required|integer'
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        // Verifikasi jumlah denda
        if ($request->amount != $peminjaman->denda) {
            return response()->json(['error' => 'Jumlah denda tidak sesuai.'], 400);
        }

        $transactionDetails = [
            'order_id' => 'DND-' . uniqid(),
            'gross_amount' => $request->amount,
        ];

        $itemDetails = [
            [
                'id' => $peminjaman->id,
                'price' => $request->amount,
                'quantity' => 1,
                'name' => 'Denda Peminjaman Buku',
            ]
        ];

        $transaction = [
            'payment_type' => 'bank_transfer',
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            \Log::error('Midtrans Payment Error: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memproses pembayaran.'], 500);
        }
    }

   
}
