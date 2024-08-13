@extends('layouts.main')

@section('content')
<div class="container" style="margin-top:20px">
    <div class="card">
        <div class="card-header">
            <h3>Edit Anggota</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $user->kelas }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="no_telfon" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="no_telfon" name="no_telfon" value="{{ $user->no_telfon }}" required>
                    </div>
                    <div class="col-md-6">
    <label for="Status_Peminjam" class="form-label">Status Peminjam</label>
    <select class="form-control" id="Status_Peminjam" name="Status_Peminjam" required>
        <option value="Boleh" {{ $user->Status_Peminjam == 'Boleh' ? 'selected' : '' }}>Boleh</option>
        <option value="Tidak" {{ $user->Status_Peminjam == 'Tidak' ? 'selected' : '' }}>Tidak</option>
    </select>
</div>

                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
