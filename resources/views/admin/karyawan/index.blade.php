@extends('_layouts.app')

@section('content')
    <div class="hstack justify-content-between gap-3 mb-4">
        <h4 class="mb-0">Data Karyawan</h4>
        <a href="{{ route('admin.karyawan.create.view') }}" class="btn btn-success">Tambah</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawans as $karyawan)
                    <tr>
                        <td>{{ $karyawan->user->name }}</td>
                        <td>{{ $karyawan->user->email }}</td>
                        <td>{{ $karyawan->jabatan }}</td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('admin.karyawan.detail.view', $karyawan->id) }}" class="btn btn-sm btn-primary">Detail</a>
                            <a href="{{ route('admin.karyawan.print', $karyawan->id) }}" class="btn btn-sm btn-info">Print</a>
                            <form action="{{ route('admin.karyawan.delete.handle', $karyawan->user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($karyawans->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data karyawan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection