@extends('layouts.master')

@section('title', 'Detail Buku')

@section('content')

    <div class="banner">
        @if ($book->foto_sampul)
            <img src="{{ Storage::url($book->foto_sampul) }}" class="card-img-top" alt="{{ $book->judul }}">
        @else
            <img src="https://via.placeholder.com/400x600?text=No+Image" class="card-img-top" alt="No Image">
        @endif
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->judul }}</h5>
                        <p class="card-text"><strong>Pengarang:</strong> {{ $book->pengarang }}</p>
                        <p class="card-text"><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit }}</p>
                        <p class="card-text"><strong>Jenis Buku:</strong> {{ $book->jenis_buku }}</p>
                        <p class="card-text"><strong>Keterangan:</strong> {{ $book->keterangan }}</p>
                    </div>
                </div>
                <a href="/landingpage" class="btn btn-primary mt-3">Kembali ke Daftar Buku</a>
            </div>

            <div class="col-md-8">
                @if ($book->file_buku)
                    <h3>File Buku:</h3>
                    <div class="embed-responsive" style="position: relative; padding-bottom: 75%; height: 0; overflow: hidden;">
                        <iframe src="{{ Storage::url($book->file_buku) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" frameborder="0"></iframe>
                    </div>
                @else
                    <p>Tidak ada file buku yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
