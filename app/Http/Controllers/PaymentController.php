<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
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
        return view('payment');
    }

    public function pay(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        $transactionDetails = [
            'order_id' => 'DND-' . uniqid(),
            'gross_amount' => $request->amount,
        ];

        $itemDetails = [
            [
                'id' => 'item1',
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
                'first_name' => 'Customer',
                'email' => 'customer@example.com',
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
