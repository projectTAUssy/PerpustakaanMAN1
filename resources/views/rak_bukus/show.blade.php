@extends('layouts.main')

@section('content')
<div class="container" style="margin-top:20px">
    <div class="card">
        <div class="card-header">
            <h3>Detail Rak Buku</h3>
        </div>
        <div class="card-body">
            <p><strong>Nomor Rak:</strong> {{ $rakBuku->nomor_rak }}</p>
            <p><strong>Nama Rak:</strong> {{ $rakBuku->nama_rak }}</p>
            <div class="d-flex justify-content-start">
                <a href="{{ route('rak_bukus.edit', $rakBuku->nomor_rak) }}" class="btn btn-warning me-2">Edit</a>
                <form action="{{ route('rak_bukus.destroy', $rakBuku->nomor_rak) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                <a href="{{ route('rak_bukus.index') }}" class="btn btn-secondary ms-2">Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</div>
@endsection
