@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Peminjaman</h5>
            <a href="{{ route('users.create') }}" class="btn btn-success btn-lg" style="background-color:#006316">
                <i class="fas fa-plus me-1"></i> Tambah Peminjaman
            </a>
        </div>

        <div class="table-responsive text-nowrap p-3">
            <table class="table table-striped" id="usersTable">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>No. Telepon</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->kelas }}</td>
                            <td>{{ $user->no_telfon }}</td>
                            <td>
                                @if($user->role_id == 1)
                                    Pustakawan
                                @elseif($user->role_id == 2)
                                    Pemustaka
                                @else
                                    Unknown
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
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
<!-- / Content -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush
