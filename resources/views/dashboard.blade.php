@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Card 1 -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total</h5>
                            <p class="card-text">Peminjaman Buku</p>
                        </div>
                        <div>
                            <i class="bx bx-book-open bx-lg"></i>
                        </div>
                    </div>
                    <h3 class="card-text text-center text-warning">{{ $totalLoans }}</h3>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total</h5>
                            <p class="card-text">Pengembalian Buku</p>
                        </div>
                        <div>
                            <i class="bx bx-book bx-lg"></i>
                        </div>
                    </div>
                    <h3 class="card-text text-center text-primary">{{ $totalReturns }}</h3>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total</h5>
                            <p class="card-text">Daftar Buku</p>
                        </div>
                        <div>
                            <i class="bx bx-book-content bx-lg"></i>
                        </div>
                    </div>
                    <h3 class="card-text text-center text-success">{{ $totalBooks }}</h3>
                </div>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total</h5>
                            <p class="card-text">Daftar Anggota</p>
                        </div>
                        <div>
                            <i class="bx bx-user bx-lg"></i>
                        </div>
                    </div>
                    <h3 class="card-text text-center text-info">{{ $totalMembers }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title text-center">Jumlah Peminjaman Buku Tiap Bulan</h5>
            <canvas id="loanChart"></canvas>
        </div>
    </div>
</div>
<!-- / Content -->

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('loanChart').getContext('2d');
    var loanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: @json($loanCounts),
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 2,
                fill: false,
                tension: 0.1,
                pointBackgroundColor: 'rgba(0, 123, 255, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(0, 123, 255, 1)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection