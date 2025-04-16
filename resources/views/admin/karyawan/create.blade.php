@extends('_layouts.app')

@section('content')
<h4 class="text-center mb-4">Tambah Karyawan Baru</h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="vstack gap-3" method="POST" action="{{ route('admin.karyawan.create.handle') }}">
    @csrf
    <div>
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div>
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div>
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div>
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <div>
        <label class="form-label">Jabatan</label>
        <input type="text" name="jabatan" class="form-control">
    </div>
    <div class="hstack gap-2">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.karyawan.view') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection