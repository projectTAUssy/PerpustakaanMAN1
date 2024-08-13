@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h3>Edit Buku</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('bukus.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nomor_rak" class="form-label">Nomor Rak</label>
                            <select class="form-control" id="nomor_rak" name="nomor_rak" required>
                                @foreach ($rak_bukus as $rak_buku)
                                    <option value="{{ $rak_buku->nomor_rak }}" {{ $buku->nomor_rak == $rak_buku->nomor_rak ? 'selected' : '' }}>{{ $rak_buku->nomor_rak }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_rak" class="form-label">Nama Rak</label>
                            <select class="form-control" id="nama_rak" name="nama_rak" required>
                                @foreach ($rak_bukus as $rak_buku)
                                    <option value="{{ $rak_buku->nama_rak }}" {{ $buku->nama_rak == $rak_buku->nama_rak ? 'selected' : '' }}>{{ $rak_buku->nama_rak }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pengarang" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $buku->pengarang }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" min="1900" max="{{ date('Y') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jenis_buku" class="form-label">Jenis Buku</label>
                            <input type="text" class="form-control" id="jenis_buku" name="jenis_buku" value="{{ $buku->jenis_buku }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="stok_tersedia" class="form-label">Stok Tersedia</label>
                            <input type="number" class="form-control" id="stok_tersedia" name="stok_tersedia" value="{{ $buku->stok_tersedia }}" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan">{{ $buku->keterangan }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="foto_sampul" class="form-label">Foto Sampul</label>
                            <input type="file" class="form-control" id="foto_sampul" name="foto_sampul">
                            @if ($buku->foto_sampul)
                                <img src="{{ asset('storage/' . $buku->foto_sampul) }}" alt="{{ $buku->judul }}" width="100" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="file_buku" class="form-label">File Buku</label>
                            <input type="file" class="form-control" id="file_buku" name="file_buku">
                            @if ($buku->file_buku)
                                <a href="{{ asset('storage/' . $buku->file_buku) }}" target="_blank" class="d-block mt-2">Lihat File</a>
                            @endif
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</div>
@endsection
