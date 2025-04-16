@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Daftar Presensi</h4>

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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="vstack gap-3">
        @foreach (['absensi' => 'Absensi', 'terlambat' => 'Terlambat', 'keluar' => 'Keluar'] as $jenis => $judul)
            @php
                $data = $presensis->where('jenis', $jenis);
                $colspan = $jenis === 'absensi' ? 7 : 9;
            @endphp
            <div class="hstack justify-content-between gap-3">
                <h4 class="mb-0">Data {{ $jenis }}</h4>
                <a href="{{ route('admin.presensi.print', $jenis) }}" class="btn btn-info btn-sm">Print</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th style="min-width: 15rem">Nama</th>
                            @if($jenis === 'absensi')
                                <th style="min-width: 10rem">Waktu</th>
                            @else
                                <th style="min-width: 10rem">Waktu Mulai</th>
                                <th style="min-width: 10rem">Waktu Selesai</th>
                                <th style="min-width: 7.5rem">Durasi</th>
                            @endif
                            <th style="min-width: 15rem">Alasan</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $presensi)
                            <tr>
                                <td>{{ $presensi->user->name ?? '-' }}</td>
                                @if($jenis === 'absensi')
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($presensi->waktu)->format('d M Y H:i') }}
                                    </td>
                                @else
                                    <td class="text-center">
                                        {{ $presensi->waktu_mulai ? \Carbon\Carbon::parse($presensi->waktu_mulai)->format('d M Y H:i') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $presensi->waktu_selesai ? \Carbon\Carbon::parse($presensi->waktu_selesai)->format('d M Y H:i') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        @if($presensi->waktu_mulai && $presensi->waktu_selesai)
                                            {{ number_format(\Carbon\Carbon::parse($presensi->waktu_mulai)->diffInMinutes($presensi->waktu_selesai), 2) }} menit
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endif
                                <td>{{ $presensi->alasan ?? '-' }}</td>
                                <td class="text-center">
                                    @if($presensi->bukti)
                                        <a href="{{ asset('storage/' . $presensi->bukti) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ match($presensi->status) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        default => 'warning'
                                    } }}">
                                        {{ ucfirst($presensi->status) }}
                                    </span>
                                </td>
                                <td class="hstack gap-2 text-center">
                                    @if($presensi->status === 'pending')
                                        <form action="{{ route('admin.presensi.approval.handle', $presensi) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.presensi.approval.handle', $presensi) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $colspan }}" class="text-center">Belum ada data {{ strtolower($judul) }}.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endsection