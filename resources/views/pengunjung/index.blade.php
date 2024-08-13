@extends('layouts.main')

@section('content')
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="card mt-2">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Tabel Pengunjung</h5>
    </div>

    <div class="table-responsive text-nowrap p-3">
    <table class="table table-striped" id="example">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>No Telepon</th>
                <th>Tanggal Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visits as $visit)
                <tr>
                    <td>{{ $visit->user->name }}</td>
                    <td>{{ $visit->user->email }}</td>
                    <td>{{ $visit->user->kelas }}</td>
                    <td>{{ $visit->user->no_telfon }}</td>
                    <td>{{ $visit->visited_at }}</td>
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
        $('#visitsTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush
