<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\CutiApproval;
use App\Models\User;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    // USER: Lihat daftar pengajuan cuti
    public function userShowList()
    {
        $adminList = User::where('role', 'admin')->get();

        $cutis = Cuti::with('approvals') // untuk melihat status approval
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();

        return view('user.cuti.index', compact('cutis', 'adminList'));
    }

    // USER: Kirim pengajuan cuti
    public function userHandleSubmit(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        // Buat pengajuan cuti
        $cuti = Cuti::create([
            'user_id' => auth()->id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
        ]);

        // Generate approval untuk semua admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            CutiApproval::create([
                'cuti_id' => $cuti->id,
                'user_id' => $admin->id,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('user.cuti.view')->with('success', 'Pengajuan cuti berhasil dikirim.');
    }

    // ADMIN: Lihat semua pengajuan cuti
    public function adminShowList()
    {
        $cutis = Cuti::with(['user', 'approvals'])->orderByDesc('created_at')->get();

        return view('admin.cuti.index', compact('cutis'));
    }

    // ADMIN: Proses approval
    public function adminHandleApproval(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'catatan' => 'nullable|string',
        ]);

        $approval = CutiApproval::where('cuti_id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $approval->status = $request->status;
        $approval->catatan = $request->catatan;
        $approval->save();

        return redirect()->route('admin.cuti.view')->with('success', 'Approval berhasil diperbarui.');
    }
}
