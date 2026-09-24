<?php

namespace App\Http\Controllers;

use App\Models\GtAbsensi;
use App\Models\Penempatan;
use App\Models\User;

class PjgtGtController extends Controller
{
    // GT yang ditempatkan admin ke lembaga milik PJGT yang login
    // (relasi: penempatans.permohonan_id -> permohonans.username = username PJGT)
    public function index()
    {
        $user = auth()->user();
        $query = Penempatan::with(['gt', 'permohonan']);
        if (($user->role ?? '') !== 'admin') {
            $query->whereHas('permohonan', function ($q) use ($user) {
                $q->where('username', $user->username);
            });
        }
        $items = $query->latest()->paginate(15);
        return view('pjgt.gt-saya', compact('items'));
    }

    // Biodata GT (read-only) — hanya GT yang ditempatkan di lembaga milik PJGT login
    public function show(User $user)
    {
        if ($user->role !== 'gt') {
            abort(404);
        }
        $me = auth()->user();
        if (($me->role ?? '') !== 'admin') {
            $boleh = Penempatan::where('gt_user_id', $user->id)
                ->whereHas('permohonan', function ($q) use ($me) {
                    $q->where('username', $me->username);
                })->exists();
            if (! $boleh) {
                abort(403, 'GT ini bukan di lembaga Anda.');
            }
        }
        $user->load('biodata');
        $biodata = $user->biodata;
        $absensiTerakhir = GtAbsensi::where('user_id', $user->id)->orderBy('tanggal', 'desc')->orderBy('id', 'desc')->take(5)->get();
        return view('pjgt.gt-show', compact('user', 'biodata', 'absensiTerakhir'));
    }
}
