@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h3 class="mb-4">Detail Buku</h3>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0" style="color:white">{{ $buku->judul }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if ($buku->foto_sampul)
                        <img src="{{ asset('storage/' . $buku->foto_sampul) }}" alt="Foto Sampul" class="img-fluid rounded mb-3">
                    @else
                        <img src="{{ asset('path/to/default-image.jpg') }}" alt="Default Image" class="img-fluid rounded mb-3">
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Nama Rak:</strong> {{ $buku->nama_rak }}</p>
                    <p><strong>Nomor Rak:</strong> {{ $buku->nomor_rak }}</p>
                    <p><strong>Pengarang:</strong> {{ $buku->pengarang }}</p>
                    <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
                    <p><strong>Jenis Buku:</strong> {{ $buku->jenis_buku }}</p>
                    <p><strong>Stok Tersedia:</strong> {{ $buku->stok_tersedia }}</p>
                    <p><strong>Keterangan:</strong> {{ $buku->keterangan }}</p>

                    @if ($buku->file_buku)
                        <a href="{{ asset('storage/' . $buku->file_buku) }}" class="btn btn-primary mb-3" target="_blank">Unduh Buku</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('bukus.index') }}" class="btn btn-secondary">Kembali ke Daftar Buku</a>
            <a href="{{ route('bukus.edit', $buku->id) }}" class="btn btn-warning">Edit Buku</a>
        </div>
    </div>
</div>
@endsection
