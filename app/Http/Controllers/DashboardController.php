<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;

use App\Models\User;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\Member;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data total
        $totalLoans = PeminjamanDetail::count();
        $totalReturns = PeminjamanDetail::count();
        $totalBooks = Buku::count();
        $totalMembers = User::where('role_id', 2)->count();

        // Mengambil data pinjaman per bulan untuk MySQL
        $loansPerMonth = PeminjamanDetail::selectRaw('DATE_FORMAT(created_at, "%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Menyiapkan data untuk chart
        $months = [];
        $loanCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = 'Bulan ' . $i;
            $loanCounts[] = $loansPerMonth[sprintf('%02d', $i)] ?? 0; // Menggunakan format dua digit untuk bulan
        }

        return view('dashboard', compact('totalLoans', 'totalReturns', 'totalBooks', 'totalMembers', 'months', 'loanCounts'));
    }


    public function exportPdf()
    {
        // Ambil semua data peminjaman
        $semuaPeminjamans = Peminjaman::with('user')->orderBy('created_at', 'desc')->get();

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $pdf = new Dompdf($options);

        // Load view ke PDF
        $view = view('peminjamans.pdf', compact('semuaPeminjamans'))->render();
        $pdf->loadHtml($view);

        // Set ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'landscape');

        // Render PDF
        $pdf->render();

        // Unduh PDF
        return $pdf->stream('peminjaman-report.pdf');
    }

}
