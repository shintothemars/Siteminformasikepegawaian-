@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Sesuaikan Profil Saya</h4>

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

    <form action="{{ route('user.profile.edit.handle') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-3">
                <div class="card text-center mb-3">
                    <div class="card-body">
                        @if ($karyawan->foto_profil)
                            <img src="{{ asset('storage/' . $karyawan->foto_profil) }}" 
                                 alt="Foto Profil" 
                                 class="img-fluid rounded-circle mb-3" 
                                 style="max-width: 150px; height: auto;">
                        @else
                            <div class="text-muted mb-3">Belum ada foto profil</div>
                        @endif
                        <div>
                            <label for="foto_profil" class="form-label">Ganti Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-header fw-bold">Informasi Umum</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', $karyawan->jabatan) }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nama_panggilan" class="form-label">Nama Panggilan</label>
                            <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{ old('nama_panggilan', $karyawan->nama_panggilan) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $karyawan->tempat_lahir) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="golongan_darah" class="form-label">Golongan Darah</label>
                            <input type="text" class="form-control" id="golongan_darah" name="golongan_darah" value="{{ old('golongan_darah', $karyawan->golongan_darah) }}">
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama</label>
                            <input type="text" class="form-control" id="agama" name="agama" value="{{ old('agama', $karyawan->agama) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header fw-bold">Identitas</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label">No KTP</label>
                            <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $karyawan->no_ktp) }}">
                        </div>
                        <div class="mb-3">
                            <label for="ktp_berlaku_sampai" class="form-label">KTP Berlaku Sampai</label>
                            <input type="date" class="form-control" id="ktp_berlaku_sampai" name="ktp_berlaku_sampai" value="{{ old('ktp_berlaku_sampai', $karyawan->ktp_berlaku_sampai) }}">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">Fisik</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" value="{{ old('tinggi_badan', $karyawan->tinggi_badan) }}">
                        </div>
                        <div class="mb-3">
                            <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" value="{{ old('berat_badan', $karyawan->berat_badan) }}">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">Keluarga</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Perkawinan</label>
                            <select class="form-select" name="status" id="status">
                                <option value="">-- Pilih --</option>
                                <option value="Kawin" {{ old('status', $karyawan->status) === 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                <option value="Belum Kawin" {{ old('status', $karyawan->status) === 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Duda/Janda" {{ old('status', $karyawan->status) === 'Duda/Janda' ? 'selected' : '' }}>Duda/Janda</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
                            <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" value="{{ old('jumlah_anak', $karyawan->jumlah_anak) }}">
                        </div>
                        <div class="mb-3">
                            <label for="anak_ke" class="form-label">Anak Ke</label>
                            <input type="text" class="form-control" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $karyawan->anak_ke) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header fw-bold">Kontak & Alamat</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $karyawan->alamat) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}">
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="tinggal_dengan_keluarga" value="0">
                            <input class="form-check-input" type="checkbox" name="tinggal_dengan_keluarga" id="tinggal_dengan_keluarga" value="1" {{ old('tinggal_dengan_keluarga', $karyawan->tinggal_dengan_keluarga) ? 'checked' : '' }}>
                            <label class="form-check-label" for="tinggal_dengan_keluarga">Tinggal dengan Keluarga</label>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold">Kontak Darurat</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="darurat_nama" class="form-label">Nama Kontak Darurat</label>
                            <input type="text" class="form-control" id="darurat_nama" name="darurat_nama" value="{{ old('darurat_nama', $karyawan->darurat_nama) }}">
                        </div>
                        <div class="mb-3">
                            <label for="darurat_hubungan" class="form-label">Hubungan</label>
                            <input type="text" class="form-control" id="darurat_hubungan" name="darurat_hubungan" value="{{ old('darurat_hubungan', $karyawan->darurat_hubungan) }}">
                        </div>
                        <div class="mb-3">
                            <label for="darurat_telepon" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="darurat_telepon" name="darurat_telepon" value="{{ old('darurat_telepon', $karyawan->darurat_telepon) }}">
                        </div>
                        <div class="mb-3">
                            <label for="darurat_alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="darurat_alamat" name="darurat_alamat">{{ old('darurat_alamat', $karyawan->darurat_alamat) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        Keluarga Lingkungan
                        <button type="button" class="btn btn-sm btn-success" id="addKeluargaBtn">Tambah</button>
                    </div>
                    <div class="card-body" id="keluargaWrapper">
                        @php
                            $keluargas = old('keluarga', $karyawan->keluargaLingkungan->toArray() ?? []);
                        @endphp
                
                        @foreach($keluargas as $i => $kel)
                            <div class="keluarga-item border rounded p-3 mb-3 position-relative">
                                <button type="button" class="btn-close position-absolute top-0 end-0 p-2 removeKeluargaBtn" aria-label="Close"></button>
                
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="keluarga[nama][]" class="form-control" value="{{ $kel['nama'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Hubungan</label>
                                        <input type="text" name="keluarga[hubungan][]" class="form-control" value="{{ $kel['hubungan'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select name="keluarga[jenis_kelamin][]" class="form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="Laki-laki" {{ ($kel['jenis_kelamin'] ?? '') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ ($kel['jenis_kelamin'] ?? '') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Umur</label>
                                        <input type="text" name="keluarga[umur][]" class="form-control" value="{{ $kel['umur'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pendidikan</label>
                                        <input type="text" name="keluarga[pendidikan][]" class="form-control" value="{{ $kel['pendidikan'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Profesi</label>
                                        <input type="text" name="keluarga[profesi][]" class="form-control" value="{{ $kel['profesi'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Telepon</label>
                                        <input type="text" name="keluarga[telepon][]" class="form-control" value="{{ $kel['telepon'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="keluarga[alamat][]" class="form-control">{{ $kel['alamat'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        Pengalaman Kerja
                        <button type="button" class="btn btn-sm btn-success" id="addPengalamanBtn">Tambah</button>
                    </div>
                    <div class="card-body" id="pengalamanWrapper">
                        @php
                            $pengalamans = old('pengalaman', $karyawan->pengalamanKerja->toArray() ?? []);
                        @endphp
                
                        @foreach ($pengalamans as $i => $peng)
                            <div class="pengalaman-item border rounded p-3 mb-3 position-relative">
                                <button type="button" class="btn-close position-absolute top-0 end-0 p-2 removePengalamanBtn" aria-label="Close"></button>
                
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Perusahaan</label>
                                        <input type="text" name="pengalaman[nama_perusahaan][]" class="form-control" value="{{ $peng['nama_perusahaan'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" name="pengalaman[jabatan][]" class="form-control" value="{{ $peng['jabatan'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mulai Bulan</label>
                                        <input type="text" name="pengalaman[mulai_bulan][]" class="form-control" value="{{ $peng['mulai_bulan'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mulai Tahun</label>
                                        <input type="text" name="pengalaman[mulai_tahun][]" class="form-control" value="{{ $peng['mulai_tahun'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sampai Bulan</label>
                                        <input type="text" name="pengalaman[sampai_bulan][]" class="form-control" value="{{ $peng['sampai_bulan'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Sampai Tahun</label>
                                        <input type="text" name="pengalaman[sampai_tahun][]" class="form-control" value="{{ $peng['sampai_tahun'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Gaji</label>
                                        <input type="text" name="pengalaman[gaji][]" class="form-control" value="{{ $peng['gaji'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alasan Keluar</label>
                                        <textarea name="pengalaman[alasan_keluar][]" class="form-control">{{ $peng['alasan_keluar'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        Referensi
                        <button type="button" class="btn btn-sm btn-success" id="addReferensiBtn">Tambah</button>
                    </div>
                    <div class="card-body" id="referensiWrapper">
                        @php
                            $referensis = old('referensi', $karyawan->referensi->toArray() ?? []);
                        @endphp
                
                        @foreach($referensis as $i => $ref)
                            <div class="referensi-item border rounded p-3 mb-3 position-relative">
                                <button type="button" class="btn-close position-absolute top-0 end-0 p-2 removeReferensiBtn" aria-label="Close"></button>
                
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="referensi[nama][]" class="form-control" value="{{ $ref['nama'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Hubungan</label>
                                        <input type="text" name="referensi[hubungan][]" class="form-control" value="{{ $ref['hubungan'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" name="referensi[alamat][]" class="form-control" value="{{ $ref['alamat'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Telepon</label>
                                        <input type="text" name="referensi[telepon][]" class="form-control" value="{{ $ref['telepon'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Profesi</label>
                                        <input type="text" name="referensi[profesi][]" class="form-control" value="{{ $ref['profesi'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" name="referensi[jabatan][]" class="form-control" value="{{ $ref['jabatan'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        Dokumen Pendukung
                        <button type="button" class="btn btn-sm btn-success" id="addDokumenBtn">Tambah</button>
                    </div>
                    <div class="card-body" id="dokumenWrapper">
                        @php
                            $dokumens = old('dokumen', $karyawan->dokumenPendukung->toArray() ?? []);
                        @endphp
                
                        @foreach($dokumens as $i => $dok)
                            <div class="dokumen-item border rounded p-3 mb-3 position-relative">
                                <button type="button" class="btn-close position-absolute top-0 end-0 p-2 removeDokumenBtn" aria-label="Close"></button>
                
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Dokumen</label>
                                        <input type="text" name="dokumen[nama_dokumen][]" class="form-control" value="{{ $dok['nama_dokumen'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">File</label>
                                        <input type="file" name="dokumen[file_path][]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="hstack gap-2">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('user.profile.view') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.getElementById('addKeluargaBtn').addEventListener('click', function () {
        const wrapper = document.getElementById('keluargaWrapper');

        const item = document.createElement('div');
        item.classList.add('keluarga-item', 'border', 'rounded', 'p-3', 'mb-3', 'position-relative');
        item.innerHTML = `
            <button type="button" class="btn-close position-absolute top-0 end-0 removeKeluargaBtn" aria-label="Close"></button>
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input type="text" name="keluarga[nama][]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hubungan</label>
                    <input type="text" name="keluarga[hubungan][]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="keluarga[jenis_kelamin][]" class="form-select">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Umur</label>
                    <input type="text" name="keluarga[umur][]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pendidikan</label>
                    <input type="text" name="keluarga[pendidikan][]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Profesi</label>
                    <input type="text" name="keluarga[profesi][]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="keluarga[telepon][]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat</label>
                    <textarea name="keluarga[alamat][]" class="form-control"></textarea>
                </div>
            </div>
        `;
        wrapper.appendChild(item);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeKeluargaBtn')) {
            e.target.closest('.keluarga-item').remove();
        }
    });
</script>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pengalamanWrapper = document.getElementById('pengalamanWrapper');
        const addPengalamanBtn = document.getElementById('addPengalamanBtn');

        addPengalamanBtn.addEventListener('click', () => {
            const firstItem = pengalamanWrapper.querySelector('.pengalaman-item');
            const clone = firstItem.cloneNode(true);
            clone.querySelectorAll('input, textarea').forEach(el => el.value = '');
            pengalamanWrapper.appendChild(clone);
        });

        pengalamanWrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('removePengalamanBtn')) {
                const item = e.target.closest('.pengalaman-item');
                if (pengalamanWrapper.querySelectorAll('.pengalaman-item').length > 1) {
                    item.remove();
                }
            }
        });
    });
</script>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const referensiWrapper = document.getElementById('referensiWrapper');
        const addReferensiBtn = document.getElementById('addReferensiBtn');

        addReferensiBtn.addEventListener('click', function () {
            const item = document.createElement('div');
            item.classList.add('referensi-item', 'border', 'rounded', 'p-3', 'mb-3', 'position-relative');
            item.innerHTML = `
                <button type="button" class="btn-close position-absolute top-0 end-0 p-2 removeReferensiBtn" aria-label="Close"></button>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Nama</label>
                        <input type="text" name="referensi[nama][]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Hubungan</label>
                        <input type="text" name="referensi[hubungan][]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="referensi[alamat][]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="referensi[telepon][]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Profesi</label>
                        <input type="text" name="referensi[profesi][]" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="referensi[jabatan][]" class="form-control">
                    </div>
                </div>
            `;
            referensiWrapper.appendChild(item);
        });

        referensiWrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('removeReferensiBtn')) {
                e.target.closest('.referensi-item').remove();
            }
        });
    });
</script>
@endpush

@push('scripts')
<script>
    document.getElementById('addDokumenBtn').addEventListener('click', function () {
        const wrapper = document.getElementById('dokumenWrapper');

        const item = document.createElement('div');
        item.classList.add('dokumen-item', 'border', 'rounded', 'p-3', 'mb-3', 'position-relative');
        item.innerHTML = `
            <button type="button" class="btn-close position-absolute top-0 end-0 p-2 removeDokumenBtn" aria-label="Close"></button>
            <div class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Nama Dokumen</label>
                    <input type="text" name="dokumen[nama_dokumen][]" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">File</label>
                    <input type="file" name="dokumen[file_path][]" class="form-control">
                </div>
            </div>
        `;

        wrapper.appendChild(item);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeDokumenBtn')) {
            e.target.closest('.dokumen-item').remove();
        }
    });
</script>
@endpush