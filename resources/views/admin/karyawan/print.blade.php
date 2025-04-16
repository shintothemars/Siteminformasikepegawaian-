@extends('_layouts.print')

@section('content')
    <div class="header">
        <img src="{{ asset('storage/' . $karyawan->foto_profil) }}" alt="Foto Profil" class="profile-photo">
        <h1>Profil Saya</h1>
        <h2>{{ $karyawan->user->name }}</h2>
    </div>
    <div class="content">
        <h3>Informasi Umum</h3>
        <table>
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
        <h3>Identitas</h3>
        <table>
            <tr>
                <th>No KTP</th>
                <td>{{ $karyawan->no_ktp ?? '-' }}</td>
            </tr>
            <tr>
                <th>KTP Berlaku Sampai</th>
                <td>{{ optional($karyawan->ktp_berlaku_sampai)->format('d M Y') ?? '-' }}</td>
            </tr>
        </table>
        <h3>Fisik</h3>
        <table>
            <tr>
                <th>Tinggi Badan</th>
                <td>{{ $karyawan->tinggi_badan ? $karyawan->tinggi_badan . ' cm' : '-' }}</td>
            </tr>
            <tr>
                <th>Berat Badan</th>
                <td>{{ $karyawan->berat_badan ? $karyawan->berat_badan . ' kg' : '-' }}</td>
            </tr>
        </table>
        <h3>Keluarga</h3>
        <table>
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
        <h3>Kontak & Alamat</h3>
        <table>
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
        <h3>Kontak Darurat</h3>
        <table>
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
        <h3>Keluarga Lingkungan</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Hubungan</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                    <th>Pendidikan</th>
                    <th>Profesi</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawan->keluargaLingkungan as $kel)
                    <tr>
                        <td>{{ $kel->nama }}</td>
                        <td>{{ $kel->hubungan }}</td>
                        <td>{{ $kel->jenis_kelamin }}</td>
                        <td>{{ $kel->umur }}</td>
                        <td>{{ $kel->pendidikan }}</td>
                        <td>{{ $kel->profesi }}</td>
                        <td>{{ $kel->telepon }}</td>
                        <td>{{ $kel->alamat }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
        <h3>Pengalaman Kerja</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Perusahaan</th>
                    <th>Jabatan</th>
                    <th>Periode</th>
                    <th>Gaji</th>
                    <th>Alasan Keluar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawan->pengalamanKerja as $exp)
                    <tr>
                        <td>{{ $exp->nama_perusahaan }}</td>
                        <td>{{ $exp->jabatan }}</td>
                        <td>{{ $exp->mulai_bulan }} {{ $exp->mulai_tahun }} - {{ $exp->sampai_bulan }} {{ $exp->sampai_tahun }}</td>
                        <td>{{ $exp->gaji }}</td>
                        <td>{{ $exp->alasan_keluar }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
        <h3>Referensi</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Hubungan</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Profesi</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawan->referensi as $ref)
                    <tr>
                        <td>{{ $ref->nama }}</td>
                        <td>{{ $ref->hubungan }}</td>
                        <td>{{ $ref->alamat }}</td>
                        <td>{{ $ref->telepon }}</td>
                        <td>{{ $ref->profesi }}</td>
                        <td>{{ $ref->jabatan }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6">Tidak ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
        <h3>Dokumen Pendukung</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama Dokumen</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawan->dokumenPendukung as $dok)
                    <tr>
                        <td>{{ $dok->nama_dokumen }}</td>
                        <td><a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank">Lihat File</a></td>
                    </tr>
                @empty
                    <tr><td colspan="2">Tidak ada dokumen.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection