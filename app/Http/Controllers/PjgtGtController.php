<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;

class PjgtGtController extends Controller
{
    // GT yang ditempatkan admin ke lembaga milik PJGT yang login
    // (relasi: penempatans.permohonan_id -> permohonans.username = username PJGT)
    public function index()
    {
        $user = auth()->user();
        $query = Penempatan::with(['gt.biodata', 'permohonan']);
        if (($user->role ?? '') !== 'admin') {
            $query->whereHas('permohonan', function ($q) use ($user) {
                $q->where('username', $user->username);
            });
        }
        $items = $query->latest()->paginate(15);
        // Dibuka = dibaca → badge merah hilang sampai ada penempatan baru/berubah
        if (($user->role ?? '') !== 'admin') {
            Penempatan::tandaiDibaca($user);
        }
        return view('pjgt.gt-saya', compact('items'));
    }
}
