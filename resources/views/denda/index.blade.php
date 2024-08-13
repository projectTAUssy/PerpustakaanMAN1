<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denda Peminjaman</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <style>
        .navbar-custom {
            background-color: #006316;
        }

        .banner {
            background-image: url('assets/img/home.png');
            background-size: cover;
            background-position: center;
            height: 400px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #006316;
            opacity: 0.5;
            filter: blur(10px);
            z-index: 1;
        }

        .banner-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .banner-text {
            color: white;
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .table-custom {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table-custom th, .table-custom td {
            vertical-align: middle;
        }

        .table-custom th {
            background-color: #f5f5f5;
        }

        .list-group-item-custom {
            background-color: #f9f9f9;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        .list-group-item-custom:last-child {
            border-bottom: none;
        }

        .pay-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .pay-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('welcome') }}">Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('welcome') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-white" href="/user/peminjaman">Info Peminjaman Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/user/pengembalian">Info Pengembalian Buku</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link text-white" href="/denda">Info Tagihan</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Pencarian" aria-label="Search">
                </form>
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link text-white btn btn-link">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3 class="mb-4">Info Tagihan Saya</h3>
        <div class="table-responsive">
            <table id="peminjamanTable" class="table table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $peminjaman->id }}</td>
                            <td>{{ $peminjaman->user->name }}</td>
                            <td>{{ $peminjaman->created_at->format('d-m-Y') }}</td>
                            <td>Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</td>
                            <td>
                                <button class="pay-button" data-id="{{ $peminjaman->id }}" data-amount="{{ $peminjaman->denda }}">Bayar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#peminjamanTable').DataTable({
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Tidak ada data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    },
                },
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

            $('.pay-button').on('click', function () {
                var peminjamanId = $(this).data('id');
                var amount = $(this).data('amount');

                $.ajax({
                    url: '{{ route('denda.pay') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        peminjaman_id: peminjamanId,
                        amount: amount
                    },
                    success: function (response) {
                        var snapToken = response.snapToken;
                        snap.pay(snapToken, {
                            onSuccess: function (result) {
                                Swal.fire("Berhasil!", "Pembayaran berhasil dilakukan.", "success");
                                // Optional: Send a request to update the denda status
                                $.ajax({
                                    url: '{{ route('denda.update') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        peminjaman_id: peminjamanId,
                                        status: 'success'
                                    },
                                    success: function () {
                                        location.reload(); // Refresh the page to update the status
                                    },
                                    error: function () {
                                        Swal.fire("Gagal!", "Terjadi kesalahan saat memperbarui status.", "error");
                                    }
                                });
                            },
                            onPending: function (result) {
                                Swal.fire("Menunggu!", "Pembayaran sedang menunggu konfirmasi.", "info");
                            },
                            onError: function (result) {
                                Swal.fire("Gagal!", "Terjadi kesalahan saat melakukan pembayaran.", "error");
                            }
                        });
                    },
                    error: function () {
                        Swal.fire("Gagal!", "Terjadi kesalahan saat melakukan pembayaran.", "error");
                    }
                });
            });
        });
    </script>
</body>
</html>
