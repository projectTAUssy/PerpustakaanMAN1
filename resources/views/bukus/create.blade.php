@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Buku</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('bukus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nomor_rak" class="form-label">Nomor Rak</label>
                        <select class="form-control" id="nomor_rak" name="nomor_rak" required>
                            @foreach ($rak_bukus as $rak_buku)
                                <option value="{{ $rak_buku->nomor_rak }}">{{ $rak_buku->nomor_rak }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_rak" class="form-label">Nama Rak</label>
                        <select class="form-control" id="nama_rak" name="nama_rak" required>
                            @foreach ($rak_bukus as $rak_buku)
                                <option value="{{ $rak_buku->nama_rak }}">{{ $rak_buku->nama_rak }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="col-md-6">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1900" max="{{ date('Y') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="jenis_buku" class="form-label">Jenis Buku</label>
                        <input type="text" class="form-control" id="jenis_buku" name="jenis_buku" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="stok_tersedia" class="form-label">Stok Tersedia</label>
                        <input type="number" class="form-control" id="stok_tersedia" name="stok_tersedia" min="0" required>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="foto_sampul" class="form-label">Foto Sampul</label>
                        <input type="file" class="form-control" id="foto_sampul" name="foto_sampul">
                    </div>
                    <div class="col-md-6">
                        <label for="file_buku" class="form-label">File Buku</label>
                        <input type="file" class="form-control" id="file_buku" name="file_buku">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
@endsection
