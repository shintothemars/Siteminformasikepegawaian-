<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function adminShowList()
    {
        $karyawans = Karyawan::with('user')->get();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function adminShowDetail($id)
    {
        $karyawan = Karyawan::with('user')->findOrFail($id);
        return view('admin.karyawan.detail', compact('karyawan'));
    }

    public function adminShowCreate()
    {
        return view('admin.karyawan.create');
    }

    public function adminHandleCreate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'jabatan' => 'required|string',
            'password' => 'required|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        $user->karyawan()->create([
            'jabatan' => $data['jabatan'],
        ]);

        return redirect()->route('admin.karyawan.view')->with('success', 'Karyawan berhasil dibuat.');
    }

    public function adminHandleDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.karyawan.view')->with('success', 'Karyawan berhasil dihapus.');
    }

    public function adminPrint($id)
    {
        $karyawan = Karyawan::with('user')->findOrFail($id);
        return view('admin.karyawan.print', compact('karyawan'));
    }

    public function userShowProfile()
    {
        $karyawan = Auth::user()->karyawan()->with([
            'keluargaLingkungan',
            'pengalamanKerja',
            'referensi',
            'dokumenPendukung'
        ])->first();

        return view('user.profile.show', compact('karyawan'));
    }

    public function userShowProfileEdit()
    {
        $karyawan = Auth::user()->karyawan()->with([
            'keluargaLingkungan',
            'pengalamanKerja',
            'referensi',
            'dokumenPendukung'
        ])->first();

        return view('user.profile.edit', compact('karyawan'));
    }

    public function userHandleProfileEdit(Request $request)
    {
        $data = $request->validate([
            'jabatan' => 'nullable|string|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_panggilan' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'golongan_darah' => 'nullable|string|max:5',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:50',
            'jumlah_anak' => 'nullable|integer|min:0',
            'anak_ke' => 'nullable|string|max:10',
            'tinggi_badan' => 'nullable|integer|min:0',
            'berat_badan' => 'nullable|integer|min:0',
            'no_ktp' => 'nullable|string|max:50',
            'ktp_berlaku_sampai' => 'nullable|date',
            'tinggal_dengan_keluarga' => 'nullable|boolean',
            'darurat_nama' => 'nullable|string|max:255',
            'darurat_hubungan' => 'nullable|string|max:255',
            'darurat_telepon' => 'nullable|string|max:20',
            'darurat_alamat' => 'nullable|string',
        ]);

        $karyawan = Auth::user()->karyawan;

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto_karyawan', 'public');
            $data['foto_profil'] = $path;
        }

        $karyawan->update($data);

        if ($request->has('keluarga')) {
            $data = $request->input('keluarga');
            $total = count($data['nama'] ?? []);

            $karyawan->keluargaLingkungan()->delete();

            for ($i = 0; $i < $total; $i++) {
                $karyawan->keluargaLingkungan()->create([
                    'nama' => $data['nama'][$i],
                    'hubungan' => $data['hubungan'][$i],
                    'jenis_kelamin' => $data['jenis_kelamin'][$i],
                    'umur' => $data['umur'][$i],
                    'pendidikan' => $data['pendidikan'][$i],
                    'alamat' => $data['alamat'][$i],
                    'profesi' => $data['profesi'][$i],
                    'telepon' => $data['telepon'][$i],
                ]);
            }
        }

        if ($request->has('pengalaman')) {
            $data = $request->input('pengalaman');
            $total = count($data['nama_perusahaan'] ?? []);

            $karyawan->pengalamanKerja()->delete();

            for ($i = 0; $i < $total; $i++) {
                $karyawan->pengalamanKerja()->create([
                    'nama_perusahaan' => $data['nama_perusahaan'][$i],
                    'jabatan' => $data['jabatan'][$i],
                    'mulai_bulan' => $data['mulai_bulan'][$i],
                    'mulai_tahun' => $data['mulai_tahun'][$i],
                    'sampai_bulan' => $data['sampai_bulan'][$i],
                    'sampai_tahun' => $data['sampai_tahun'][$i],
                    'gaji' => $data['gaji'][$i],
                    'alasan_keluar' => $data['alasan_keluar'][$i],
                ]);
            }
        }

        if ($request->has('referensi')) {
            $data = $request->input('referensi');
            $total = count($data['nama'] ?? []);

            $karyawan->referensi()->delete();

            for ($i = 0; $i < $total; $i++) {
                $karyawan->referensi()->create([
                    'nama' => $data['nama'][$i],
                    'hubungan' => $data['hubungan'][$i],
                    'alamat' => $data['alamat'][$i],
                    'telepon' => $data['telepon'][$i],
                    'profesi' => $data['profesi'][$i],
                    'jabatan' => $data['jabatan'][$i],
                ]);
            }
        }

        if ($request->has('dokumen')) {
            $data = $request->input('dokumen');
            $files = $request->file('dokumen.file_path', []);
            $total = count($data['nama_dokumen'] ?? []);

            for ($i = 0; $i < $total; $i++) {
                $dokumenId = $data['id'][$i] ?? null;
                $uploadedFile = $files[$i] ?? null;
                $namaDokumen = $data['nama_dokumen'][$i] ?? null;

                // Jika ID tersedia, berarti update
                if ($dokumenId) {
                    $dokumen = $karyawan->dokumenPendukung()->find($dokumenId);

                    if ($dokumen) {
                        $updateData = ['nama_dokumen' => $namaDokumen];

                        // Jika ada file baru, update path-nya
                        if ($uploadedFile) {
                            $filePath = $uploadedFile->store('dokumen_pendukung', 'public');
                            $updateData['file_path'] = $filePath;
                        }

                        $dokumen->update($updateData);
                    }
                } else {
                    // Tambah data baru, file wajib
                    if (!$uploadedFile || !$namaDokumen) {
                        continue;
                    }

                    $filePath = $uploadedFile->store('dokumen_pendukung', 'public');

                    $karyawan->dokumenPendukung()->create([
                        'nama_dokumen' => $namaDokumen,
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        return redirect()->route('user.profile.view')->with('success', 'Data diri berhasil diperbarui.');
    }

    public function userPrint()
    {
        $karyawan = Auth::user()->karyawan;
        return view('user.profile.print', compact('karyawan'));
    }
}
