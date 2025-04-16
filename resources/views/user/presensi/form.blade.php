@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Form Pengajuan Presensi</h4>

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

    <div class="card shadow-sm">
        <div class="card-body">
            <form class="vstack gap-3" action="{{ route('user.presensi.form.handle') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="jenis" class="form-label">Jenis Presensi <span class="text-danger">*</span></label>
                    <select name="jenis" id="jenis" class="form-select" required>
                        <option value="" disabled selected>Pilih jenis</option>
                        <option value="absensi" {{ old('jenis') == 'absensi' ? 'selected' : '' }}>Absensi</option>
                        <option value="terlambat" {{ old('jenis') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        <option value="keluar" {{ old('jenis') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>

                {{-- Untuk absensi --}}
                <div id="waktu-field">
                    <label for="waktu" class="form-label">Waktu Presensi <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="waktu" id="waktu" class="form-control" value="{{ old('waktu') }}">
                </div>

                {{-- Untuk terlambat atau keluar --}}
                <div class="vstack gap-3" id="rentang-waktu-field" style="display: none;">
                    <div>
                        <label for="waktu_mulai" class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') }}">
                    </div>
                    <div>
                        <label for="waktu_selesai" class="form-label">Waktu Selesai <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ old('waktu_selesai') }}">
                    </div>
                </div>

                <div>
                    <label for="alasan" class="form-label">Alasan Pengajuan <span class="text-danger">*</span></label>
                    <textarea name="alasan" id="alasan" class="form-control" rows="4" required>{{ old('alasan') }}</textarea>
                </div>

                <div>
                    <label for="bukti" class="form-label">Upload Bukti Pendukung</label>
                    <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*">
                    <div class="form-text">Format: JPG, PNG | Maks 2MB</div>
                </div>

                <div class="hstack gap-2">
                    <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                    <a href="{{ route('user.presensi.view') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jenisSelect = document.getElementById('jenis');
            const waktuField = document.getElementById('waktu-field');
            const rentangWaktuField = document.getElementById('rentang-waktu-field');

            function toggleWaktuFields() {
                const selectedJenis = jenisSelect.value;
                if (selectedJenis === 'terlambat' || selectedJenis === 'keluar') {
                    waktuField.style.display = 'none';
                    rentangWaktuField.style.display = '';
                } else {
                    waktuField.style.display = '';
                    rentangWaktuField.style.display = 'none';
                }
            }

            jenisSelect.addEventListener('change', toggleWaktuFields);
            toggleWaktuFields(); // Jalankan saat halaman pertama kali dimuat
        });
    </script>
@endsection