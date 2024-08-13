@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h3>Detail Peminjaman</h3>
        </div>
        <div class="card-body">
            <p><strong>Pengguna:</strong> {{ $peminjaman->user->name }}</p>
            <p><strong>Tanggal Peminjaman:</strong> {{ $peminjaman->created_at->format('d-m-Y H:i:s') }}</p>

            <h4>Detail Buku</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman->details as $detail)
                        <tr>
                            <td>{{ $detail->buku->judul }}</td>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('peminjaman.index') }}" class="btn btn-primary" style="margin-top:20px">Kembali</a>
        </div>
    </div>
</div>
@endsection
