@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman Dikembalikan</h5>
            <!-- Uncomment the buttons below if needed -->
            <!--
            <div>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-success btn-lg">
                    <i class="fas fa-plus me-1"></i> Tambah Peminjaman
                </a>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-eye me-1"></i> Lihat Dipinjam
                </a>
                <a href="{{ route('peminjaman.all') }}" class="btn btn-info btn-lg">
                    <i class="fas fa-list me-1"></i> Lihat Semua
                </a>
            </div>
            -->
        </div>

        
    <div class="table-responsive text-nowrap p-3">
      <table class="table table-striped" id="example">
                <thead>
                    <tr class="text-nowrap">
                        <th>Nama Pengguna</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Jumlah Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->user->name }}</td>
                        <td>{{ $peminjaman->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>
                            @if($peminjaman->tanggal_pengembalian)
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d-m-Y') }}
                            @else
                            Belum ditentukan
                            @endif
                        </td>
                        <td>{{ $peminjaman->status }}</td>
                        <td>{{ $peminjaman->details->sum('jumlah') }} Buku</td>
                        <td>
                            <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Are you sure?')">
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
        $('#peminjamanTable').DataTable();
    });
</script>
@endpush
