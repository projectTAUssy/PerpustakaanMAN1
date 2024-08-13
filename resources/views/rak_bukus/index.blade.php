@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Rak Buku</h5>
            <a href="{{ route('rak_bukus.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Rak Buku
            </a>
        </div>

        <div class="table-responsive text-nowrap p-3">
        <table class="table table-striped" id="example">
                <thead>
                    <tr class="text-nowrap">
                        <th>Nomor Rak</th>
                        <th>Nama Rak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rakBuku as $rak)
                    <tr>
                        <td>{{ $rak->nomor_rak }}</td>
                        <td>{{ $rak->nama_rak }}</td>
                        <td>
                            <a href="{{ route('rak_bukus.show', $rak->nomor_rak) }}" class="btn btn-info btn-sm" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('rak_bukus.edit', $rak->nomor_rak) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('rak_bukus.destroy', $rak->nomor_rak) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rak buku ini?');">
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#rakBukuTable').DataTable();
    });
</script>
@endpush
