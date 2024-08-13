@extends('layouts.main')

@section('content')
<div class="container" style="margin-top:20px">
    <div class="card">
        <div class="card-header">
            <h3>Edit Rak Buku</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('rak_bukus.update', $rakBuku->nomor_rak) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_rak" class="form-label">Nama Rak</label>
                    <input type="text" class="form-control" id="nama_rak" name="nama_rak" value="{{ old('nama_rak', $rakBuku->nama_rak) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
