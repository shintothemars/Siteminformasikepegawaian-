@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Pengajuan Cuti Karyawan</h4>

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
                    <th style="min-width: 10rem">Nama</th>
                    <th style="min-width: 7.5rem">Dari</th>
                    <th style="min-width: 7.5rem">Hingga</th>
                    <th style="min-width: 15rem">Alasan</th>
                    <th>Saya</th>
                    <th>Umum</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cutis as $cuti)
                    @php
                        $myApproval = $cuti->approvals->firstWhere('user_id', auth()->id());
                        $total = $cuti->approvals->count();
                        $approved = $cuti->approvals->where('status', 'approved')->count();
                        $rejected = $cuti->approvals->where('status', 'rejected')->count();

                        if ($rejected > 0) {
                            $overallStatus = 'Ditolak';
                            $badge = 'danger';
                        } elseif ($approved === $total) {
                            $overallStatus = 'Disetujui';
                            $badge = 'success';
                        } else {
                            $overallStatus = 'Menunggu';
                            $badge = 'secondary';
                        }
                    @endphp
                    <tr>
                        <td>{{ $cuti->user->name }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}</td>
                        <td>{{ $cuti->alasan }}</td>
                        <td class="text-center">
                            @if($myApproval)
                                <span class="badge bg-{{ $myApproval->status === 'approved' ? 'success' : ($myApproval->status === 'rejected' ? 'danger' : 'secondary') }}">
                                    {{ ucfirst($myApproval->status) }}
                                </span>
                            @else
                                <span class="badge bg-warning">Belum Ditugaskan</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $badge }}">{{ $overallStatus }}</span>
                        </td>
                        <td class="text-center text-nowrap">
                            @if($myApproval && $myApproval->status === 'pending')
                                <form action="{{ route('admin.cuti.approval', $cuti->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success">Setuju</button>
                                </form>
                                <form action="{{ route('admin.cuti.approval', $cuti->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                </form>
                            @else
                                <span class="text-muted">Sudah Diproses</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada pengajuan cuti.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection