<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function adminShowList()
    {
        // Menambahkan eager loading 'user' untuk presensi
        $presensis = Presensi::with('user')->orderByDesc('waktu')->get();
        return view('admin.presensi.index', compact('presensis'));
    }

    public function adminHandleApproval(Request $request, $id)
    {
        // Validasi status pengajuan (approved/rejected)
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Ambil presensi yang ingin diubah statusnya
        $presensi = Presensi::findOrFail($id);

        // Ubah status pengajuan
        $presensi->status = $request->status;
        $presensi->save();

        return redirect()->route('admin.presensi.view')->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function adminPrint($jenis)
    {
        // Ambil data berdasarkan jenis presensi
        $data = Presensi::with('user')
            ->where('jenis', $jenis)
            ->orderBy('created_at', 'desc')
            ->get();

        // Kirim data dan jenis ke view cetak
        return view('admin.presensi.print', compact('data', 'jenis'));
    }

    public function userShowList()
    {
        $user = auth()->user();

        // Ambil daftar presensi pengguna
        $presensis = Presensi::where('user_id', $user->id)
            ->orderByDesc('waktu')
            ->get();

        return view('user.presensi.index', compact('presensis'));
    }

    public function userShowForm()
    {
        // Menampilkan form pengajuan presensi
        return view('user.presensi.form');
    }

    public function userHandleForm(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'jenis' => 'required|in:absensi,terlambat,keluar',
            'alasan' => 'required|string|max:255',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $jenis = $request->jenis;

        // Validasi waktu berdasarkan jenis
        if (in_array($jenis, ['terlambat', 'keluar'])) {
            $request->validate([
                'waktu_mulai' => 'required|date',
                'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            ]);
            $waktu = $request->waktu_mulai;
            $waktuMulai = $request->waktu_mulai;
            $waktuSelesai = $request->waktu_selesai;
        } else {
            $request->validate([
                'waktu' => 'required|date',
            ]);
            $waktu = $request->waktu;
            $waktuMulai = null;
            $waktuSelesai = null;
        }

        $user = auth()->user();

        // Cek duplikasi pengajuan pada waktu yang sama
        $alreadyExists = Presensi::where('user_id', $user->id)
            ->where('waktu', $waktu)
            ->exists();

        if ($alreadyExists) {
            return redirect()->route('user.presensi.view')
                ->with('error', 'Anda sudah mengajukan presensi pada waktu tersebut.');
        }

        // Simpan bukti jika diunggah
        $buktiPath = null;
        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti_pengajuan', 'public');
        }

        // Simpan pengajuan presensi
        Presensi::create([
            'user_id' => $user->id,
            'jenis' => $jenis,
            'waktu' => $waktu,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'status' => 'pending',
            'alasan' => $request->alasan,
            'bukti' => $buktiPath,
        ]);

        return redirect()->route('user.presensi.view')
            ->with('success', 'Pengajuan berhasil dikirim.');
    }
}
