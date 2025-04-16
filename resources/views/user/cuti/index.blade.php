@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Pengajuan Cuti</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">Ajukan Cuti Baru</div>
        <div class="card-body">
            <form class="vstack gap-3" action="{{ route('user.cuti.handle') }}" method="POST">
                @csrf
                <div>
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                <div>
                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>
                <div>
                    <label for="alasan" class="form-label">Alasan</label>
                    <textarea name="alasan" class="form-control" rows="3" required></textarea>
                </div>
                <div class="hstack gap-2">
                    <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
                </div>
            </form>
        </div>
    </div>

    <h4 class="text-center mb-4">Riwayat Pengajuan</h4>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th style="min-width: 7.5rem">Dari</th>
                    <th style="min-width: 7.5rem">Hingga</th>
                    <th style="min-width: 15rem">Alasan</th>
                    <th>Status</th>
                    <th style="min-width: 15rem">Persetujuan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cutis as $cuti)
                    @php
                        $total = $cuti->approvals->count();
                        $approved = $cuti->approvals->where('status', 'approved')->count();
                        $rejected = $cuti->approvals->where('status', 'rejected')->count();
                        $pending = $cuti->approvals->where('status', 'pending')->count();

                        if ($rejected > 0) {
                            $overallStatus = 'Ditolak';
                            $badge = 'danger';
                        } elseif ($approved === $total && $pending === 0) {
                            $overallStatus = 'Disetujui';
                            $badge = 'success';
                        } else {
                            $overallStatus = 'Menunggu';
                            $badge = 'secondary';
                        }
                    @endphp
                    <tr>
                        <td class="text-center">{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M Y') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M Y') }}</td>
                        <td>{{ $cuti->alasan }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ $badge }}">{{ $overallStatus }}</span>
                        </td>
                        <td>
                            <ul class="mb-0 list-unstyled">
                                @foreach ($adminList as $admin)
                                    @php
                                        $approval = $cuti->approvals->firstWhere('user_id', $admin->id);
                                        $status = $approval->status ?? 'pending';
                                        $catatan = $approval->catatan ?? null;

                                        $badgeStatus = match($status) {
                                            'approved' => 'success',
                                            'rejected' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <li class="mb-1">
                                        <strong>{{ $admin->name }}</strong>:
                                        <span class="badge bg-{{ $badgeStatus }}">{{ ucfirst($status) }}</span>
                                        @if ($catatan)
                                            <br><small><em>Catatan: {{ $catatan ?? "Tidak ada" }}</em></small>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada pengajuan cuti.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection