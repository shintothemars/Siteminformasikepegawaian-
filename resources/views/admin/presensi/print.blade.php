@extends('_layouts.print')

@section('content')
    <h2>Daftar Presensi ({{ ucfirst($jenis) }})</h2>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                @if($jenis === 'absensi')
                    <th>Waktu</th>
                @else
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Durasi</th>
                @endif
                <th>Alasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $presensi)
                <tr>
                    <td class="text-left">{{ $presensi->user->name ?? '-' }}</td>

                    @if($jenis === 'absensi')
                        <td>{{ \Carbon\Carbon::parse($presensi->waktu)->format('d M Y H:i') }}</td>
                    @else
                        <td>{{ $presensi->waktu_mulai ? \Carbon\Carbon::parse($presensi->waktu_mulai)->format('d M Y H:i') : '-' }}</td>
                        <td>{{ $presensi->waktu_selesai ? \Carbon\Carbon::parse($presensi->waktu_selesai)->format('d M Y H:i') : '-' }}</td>
                        <td>
                            @if($presensi->waktu_mulai && $presensi->waktu_selesai)
                                {{ number_format(\Carbon\Carbon::parse($presensi->waktu_mulai)->diffInMinutes($presensi->waktu_selesai), 2) }} menit
                            @else
                                -
                            @endif
                        </td>
                    @endif

                    <td class="text-left">{{ $presensi->alasan ?? '-' }}</td>
                    <td>{{ ucfirst($presensi->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $jenis === 'absensi' ? 5 : 7 }}">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection