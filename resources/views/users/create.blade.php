@extends('layouts.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Buat Pengguna</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="role_id" class="form-label">Peran</label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            <option value="1">Admin</option>
                            <option value="2">Member</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" required>
                    </div>
                    <div class="col-md-6">
                        <label for="no_telfon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telfon" name="no_telfon" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="Status_Peminjam" class="form-label">Status Peminjam</label>
                        <select class="form-control" id="Status_Peminjam" name="Status_Peminjam" required>
                            <option value="Boleh Meminjam">Boleh Meminjam</option>
                            <option value="Tidak Boleh Meminjam">Tidak Boleh Meminjam</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Buat</button>
            </form>
        </div>
    </div>
</div>
@endsection
