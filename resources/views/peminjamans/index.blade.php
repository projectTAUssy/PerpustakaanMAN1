@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman</h5>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus me-1"></i> Tambah Peminjaman
            </a>
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
                        <th>Denda</th>
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
                        <td style="color: red;"><b>
                            Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}</b>
                        </td>
                        <td>
                            @if($peminjaman->status != 'Dikembalikan')
                                @if($peminjaman->denda > 0)
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#dendaModal">
                                    <i class="fas fa-exclamation-triangle"></i> Bayar Denda
                                </button>
                                @else
                                <form action="{{ route('peminjaman.updateStatus', $peminjaman->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" title="Dikembalikan">
                                        <i class="fas fa-undo-alt"></i>
                                    </button>
                                </form>
                                @endif
                            @endif
                            <a href="{{ route('peminjaman.show', $peminjaman->id) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin?')">
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

<!-- Modal -->
<div class="modal fade" id="dendaModal" tabindex="-1" aria-labelledby="dendaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dendaModalLabel">Peringatan Pembayaran Denda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Silakan lakukan pembayaran denda terlebih dahulu sebelum melakukan pengembalian buku.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
