@extends('_layouts.app')

@section('content')
    <div class="hstack justify-content-between gap-3 mb-4">
        <h4 class="mb-0">Riwayat Pengajuan Presensi</h4>
        <a href="{{ route('user.presensi.form.view') }}" class="btn btn-success">Tambah</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @php
        $grouped = $presensis->groupBy('jenis');
    @endphp

    <div class="vstack gap-3">
        @forelse($grouped as $jenis => $items)
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th class="table-secondary text-capitalize" colspan="{{ in_array($jenis, ['terlambat', 'keluar']) ? 6 : 4 }}">{{ $jenis }}</th>
                        </tr>
                        <tr>
                            @if(in_array($jenis, ['terlambat', 'keluar']))
                                <th style="min-width: 10rem">Waktu Mulai</th>
                                <th style="min-width: 10rem">Waktu Selesai</th>
                                <th style="min-width: 7.5rem">Durasi</th>
                            @else
                                <th style="min-width: 10rem">Waktu</th>
                            @endif
                            <th style="min-width: 15rem">Alasan</th>
                            <th>Status</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $presensi)
                            <tr>
                                @if(in_array($presensi->jenis, ['terlambat', 'keluar']))
                                    <td class="text-center">
                                        {{ $presensi->waktu_mulai ? \Carbon\Carbon::parse($presensi->waktu_mulai)->format('d M Y H:i') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $presensi->waktu_selesai ? \Carbon\Carbon::parse($presensi->waktu_selesai)->format('d M Y H:i') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        @if($presensi->waktu_mulai && $presensi->waktu_selesai)
                                            {{ \Carbon\Carbon::parse($presensi->waktu_mulai)->diffInMinutes(\Carbon\Carbon::parse($presensi->waktu_selesai)) }} menit
                                        @else
                                            -
                                        @endif
                                    </td>
                                @else
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($presensi->waktu)->format('d M Y H:i') }}
                                    </td>
                                @endif

                                <td>{{ $presensi->alasan ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ match($presensi->status) {
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        default => 'warning'
                                    } }}">
                                        {{ ucfirst($presensi->status) }}
                                    </span>
                                </td>
                                <td class="text-center text-nowrap">
                                    @if($presensi->bukti)
                                        <a href="{{ asset('storage/' . $presensi->bukti) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <div class="alert alert-warning text-center">Tidak ada data pengajuan presensi.</div>
        @endforelse
    </div>
@endsection