@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0" sty>Daftar Buku</h5>
            <a href="{{ route('bukus.create') }}" class="btn btn-success btn-lg" >
                <i class="fas fa-plus me-1"></i> Tambah Buku
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive text-nowrap p-3">
                <table class="table table-striped" id="example">
                    <thead>
                        <tr class="text-nowrap">
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Tahun Terbit</th>
                            <th>Stok Tersedia</th>
                            <th>Keterangan</th>
                            <th>Foto Sampul</th>
                            <th>File Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukus as $buku)
                            <tr>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ $buku->tahun_terbit }}</td>
                                <td>{{ $buku->stok_tersedia }}</td>
                                <td>{{ $buku->keterangan }}</td>
                                <td>
                                    @if ($buku->foto_sampul)
                                        <img src="{{ asset('storage/' . $buku->foto_sampul) }}" alt="{{ $buku->judul }}" class="img-thumbnail" width="50">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($buku->file_buku)
                                        <a href="{{ asset('storage/' . $buku->file_buku) }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                            <i class="fas fa-file-pdf"></i> Lihat File
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada file</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('bukus.show', $buku->id) }}" class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('bukus.edit', $buku->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endpush
