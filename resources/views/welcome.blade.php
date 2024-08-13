@extends('layouts.master')

@section('title', 'Library')

@section('content')
    <div class="banner">
        <div class="banner-content">
            <div class="banner-text">SELAMAT MEMBACA</div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img style="max-height: 450px" src="{{ $book->foto_sampul ? Storage::url($book->foto_sampul) : 'https://via.placeholder.com/200x300?text=No+Image' }}" class="card-img-top" alt="{{ $book->judul }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->judul }}</h5>
                            <a href="{{ route('book.detail', $book->id) }}" class="btn btn-success" style="background-color:#009621">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
