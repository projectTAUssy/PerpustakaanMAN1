@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header">
            <h3>Edit Peminjaman</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="user_id" class="form-label">Pilih Pengguna</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $peminjaman->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="books-container">
                    <h4>Buku</h4>
                    <button type="button" class="btn btn-primary" id="add-book">Tambah Buku</button>
                    <div id="book-fields">
                        @foreach($peminjaman->details as $index => $detail)
                            <div class="book-entry mb-3">
                                <label for="books[{{ $index }}][id]" class="form-label">Pilih Buku {{ $index + 1 }}</label>
                                <select id="books[{{ $index }}][id]" name="books[{{ $index }}][id]" class="form-select" required>
                                    @foreach($bukus as $buku)
                                        <option value="{{ $buku->id }}" {{ $buku->id == $detail->buku_id ? 'selected' : '' }}>{{ $buku->judul }}</option>
                                    @endforeach
                                </select>
                                <label for="books[{{ $index }}][jumlah]" class="form-label">Jumlah</label>
                                <input type="number" id="books[{{ $index }}][jumlah]" name="books[{{ $index }}][jumlah]" class="form-control" value="{{ $detail->jumlah }}" required min="1">
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Simpan Peminjaman</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('add-book').addEventListener('click', function() {
    const container = document.getElementById('book-fields');
    const index = container.children.length;
    const html = `
        <div class="book-entry mb-3">
            <label for="books[${index}][id]" class="form-label">Pilih Buku ${index + 1}</label>
            <select id="books[${index}][id]" name="books[${index}][id]" class="form-select" required>
                @foreach($bukus as $buku)
                    <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                @endforeach
            </select>
            <label for="books[${index}][jumlah]" class="form-label">Jumlah</label>
            <input type="number" id="books[${index}][jumlah]" name="books[${index}][jumlah]" class="form-control" required min="1">
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
});
</script>
@endsection
