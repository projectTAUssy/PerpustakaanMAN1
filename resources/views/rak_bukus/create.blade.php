@extends('layouts.main')

@section('content')
<div class="container" style="margin-top:20px">
    <div class="card">
        <div class="card-header">
            <h3>Tambah Rak Buku</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('rak_bukus.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nomor_rak" class="form-label">Nomor Rak</label>
                    <input type="text" class="form-control" id="nomor_rak" name="nomor_rak" required>
                </div>
                <div class="mb-3">
                    <label for="nama_rak" class="form-label">Nama Rak</label>
                    <input type="text" class="form-control" id="nama_rak" name="nama_rak" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
