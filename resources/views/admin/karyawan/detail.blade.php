@extends('_layouts.app')

@section('content')
    <h4 class="text-center mb-4">Informasi Karyawan</h4>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center mb-3">
                <div class="card-body">
                    @if ($karyawan->foto_profil)
                        <img src="{{ asset('storage/' . $karyawan->foto_profil) }}"
                             alt="Foto Profil"
                             class="img-fluid rounded-circle mb-3"
                             style="max-width: 200px; height: auto;">
                    @else
                        <div class="text-muted">Belum ada foto profil</div>
                    @endif
                    <h5 class="mt-2">{{ $karyawan->user->name }}</h5>
                    <p class="mb-0">{{ $karyawan->jabatan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-3">
                <div class="card-header fw-bold">Informasi Umum</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $karyawan->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $karyawan->jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Panggilan</th>
                            <td>{{ $karyawan->nama_panggilan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>
                                {{ $karyawan->tempat_lahir ?? '-' }},
                                {{ optional($karyawan->tanggal_lahir)->format('d M Y') ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Golongan Darah</th>
                            <td>{{ $karyawan->golongan_darah ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $karyawan->agama ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header fw-bold">Identitas</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>No KTP</th>
                            <td>{{ $karyawan->no_ktp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>KTP Berlaku Sampai</th>
                            <td>{{ optional($karyawan->ktp_berlaku_sampai)->format('d M Y') ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Fisik</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Tinggi Badan</th>
                            <td>{{ $karyawan->tinggi_badan ? $karyawan->tinggi_badan . ' cm' : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Berat Badan</th>
                            <td>{{ $karyawan->berat_badan ? $karyawan->berat_badan . ' kg' : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Keluarga</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Status</th>
                            <td>{{ $karyawan->status ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Anak</th>
                            <td>{{ $karyawan->jumlah_anak ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Anak Ke</th>
                            <td>{{ $karyawan->anak_ke ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header fw-bold">Kontak & Alamat</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $karyawan->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $karyawan->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tinggal dengan Keluarga</th>
                            <td>{{ $karyawan->tinggal_dengan_keluarga ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Kontak Darurat</div>
                <div class="card-body">
                    <table class="table mb-0">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $karyawan->darurat_nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Hubungan</th>
                            <td>{{ $karyawan->darurat_hubungan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $karyawan->darurat_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $karyawan->darurat_alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header fw-bold">Keluarga</div>
                <div class="card-body">
                    @if($karyawan->keluargaLingkungan->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 7.5rem">Hubungan</th>
                                        <th style="min-width: 10rem">Nama</th>
                                        <th>Gender</th>
                                        <th>Umur</th>
                                        <th>Pendidikan</th>
                                        <th style="min-width: 15rem">Alamat</th>
                                        <th>Profesi</th>
                                        <th>Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($karyawan->keluargaLingkungan as $keluarga)
                                        <tr>
                                            <td>{{ $keluarga->hubungan }}</td>
                                            <td>{{ $keluarga->nama }}</td>
                                            <td>{{ $keluarga->jenis_kelamin ?? '-' }}</td>
                                            <td>{{ $keluarga->umur ?? '-' }}</td>
                                            <td>{{ $keluarga->pendidikan ?? '-' }}</td>
                                            <td>{{ $keluarga->alamat ?? '-' }}</td>
                                            <td>{{ $keluarga->profesi ?? '-' }}</td>
                                            <td>{{ $keluarga->telepon ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-muted">Belum ada data keluarga</div>
                    @endif
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Pengalaman Kerja</div>
                <div class="card-body">
                    @if($karyawan->pengalamanKerja->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 10rem">Nama Perusahaan</th>
                                        <th style="min-width: 7.5rem">Jabatan</th>
                                        <th style="min-width: 10rem">Periode</th>
                                        <th>Gaji</th>
                                        <th style="min-width: 15rem">Alasan Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($karyawan->pengalamanKerja as $pengalaman)
                                        <tr>
                                            <td>{{ $pengalaman->nama_perusahaan }}</td>
                                            <td>{{ $pengalaman->jabatan }}</td>
                                            <td>{{ $pengalaman->mulai_bulan }} {{ $pengalaman->mulai_tahun }} - {{ $pengalaman->sampai_bulan }} {{ $pengalaman->sampai_tahun }}</td>
                                            <td>{{ $pengalaman->gaji ?? '-' }}</td>
                                            <td>{{ $pengalaman->alasan_keluar ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-muted">Belum ada data pengalaman kerja</div>
                    @endif
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Referensi</div>
                <div class="card-body">
                    @if($karyawan->referensi->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th style="min-width: 10rem">Nama</th>
                                        <th style="min-width: 7.5rem">Hubungan</th>
                                        <th style="min-width: 7.5rem">Jabatan</th>
                                        <th style="min-width: 15rem">Alamat</th>
                                        <th style="min-width: 7.5rem">Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($karyawan->referensi as $referensi)
                                        <tr>
                                            <td>{{ $referensi->nama }}</td>
                                            <td>{{ $referensi->hubungan }}</td>
                                            <td>{{ $referensi->jabatan ?? '-' }}</td>
                                            <td>{{ $referensi->alamat ?? '-' }}</td>
                                            <td>{{ $referensi->telepon ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-muted">Belum ada data referensi</div>
                    @endif
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header fw-bold">Dokumen Pendukung</div>
                <div class="card-body">
                    @if($karyawan->dokumenPendukung->isNotEmpty())
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Dokumen</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($karyawan->dokumenPendukung as $dokumen)
                                    <tr>
                                        <td>{{ $dokumen->nama_dokumen }}</td>
                                        <td><a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank">Lihat Dokumen</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-muted">Belum ada dokumen pendukung</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.karyawan.view') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection