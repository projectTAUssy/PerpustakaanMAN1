@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Tambah Peminjaman</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <!-- Pilih Pengguna -->
                <div class="mb-3">
                    <label for="user_id" class="form-label">Pilih Pengguna</label>
                    <select id="user_id" name="user_id" class="form-select" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Pengembalian -->
                <div class="mb-3">
                    <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                    <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="form-control">
                </div>

                <!-- Tabel Buku Sementara -->
                <div class="mb-3">
                    <h5>Buku yang Dipilih</h5>
                    <button type="button" class="btn btn-primary mb-3" id="add-book">Tambah Buku</button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="book-table">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Tahun Terbit</th>
                                    <th>Jenis Buku</th>
                                    <th>Jumlah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be added dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Simpan Peminjaman</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Denda -->
<div class="modal fade" id="dendaModal" tabindex="-1" aria-labelledby="dendaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dendaModalLabel">Peringatan Pembayaran Denda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda tidak dapat melakukan peminjaman baru karena memiliki denda yang belum dibayar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('add-book').addEventListener('click', function() {
    const table = document.getElementById('book-table').getElementsByTagName('tbody')[0];
    const rowCount = table.rows.length;
    const index = rowCount;
    const books = @json($bukus);
    const bookOptions = books.map(b => `
        <option value="${b.id}" data-pengarang="${b.pengarang}" data-tahun="${b.tahun_terbit}" data-jenis="${b.jenis_buku}">
            ${b.judul}
        </option>
    `).join('');
    
    const rowHtml = `
        <tr>
            <td>
                <select name="books[${index}][id]" class="form-select" required onchange="updateBookInfo(this)">
                    ${bookOptions}
                </select>
            </td>
            <td><input type="text" name="books[${index}][pengarang]" class="form-control" readonly></td>
            <td><input type="text" name="books[${index}][tahun_terbit]" class="form-control" readonly></td>
            <td><input type="text" name="books[${index}][jenis_buku]" class="form-control" readonly></td>
            <td>
                <input type="number" name="books[${index}][jumlah]" class="form-control" required min="1">
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-book">Hapus</button>
            </td>
        </tr>
    `;
    
    table.insertAdjacentHTML('beforeend', rowHtml);
});

function updateBookInfo(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const row = selectElement.closest('tr');
    row.querySelector('input[name$="[pengarang]"]').value = selectedOption.getAttribute('data-pengarang');
    row.querySelector('input[name$="[tahun_terbit]"]').value = selectedOption.getAttribute('data-tahun');
    row.querySelector('input[name$="[jenis_buku]"]').value = selectedOption.getAttribute('data-jenis');
}

document.getElementById('book-table').addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-book')) {
        event.target.closest('tr').remove();
    }
});
</script>
@endsection
