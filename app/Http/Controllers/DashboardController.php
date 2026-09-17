<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isAdmin = $user->role === 'admin';
        $isPjgt = $user->role === 'pjgt';
        $isGt = $user->role === 'gt';

        // Base query filtered by role
        $base = Permohonan::query();
        if ($isPjgt) $base->where('username', $user->username);
        elseif ($isGt) $base->where('status', 'Diterima');

        $total = (clone $base)->count();
        $proses = (clone $base)->where('status','Proses')->count();
        $diterima = (clone $base)->where('status','Diterima')->count();
        $ditolak = (clone $base)->where('status','Ditolak')->count();
        $butuhGt = (clone $base)->sum('butuh_gt');
        $madrasahDistinct = (clone $base)->distinct()->count('nama_madrasah');
        $pjgtDistinct = Permohonan::distinct()->count('username');
        // Global for admin header
        $allTotal = Permohonan::count();
        $allProses = Permohonan::where('status','Proses')->count();

        $byStatus = (clone $base)->selectRaw('status, count(*) as c')->groupBy('status')->pluck('c','status');
        $byRapot = (clone $base)->selectRaw('rapot, count(*) as c')->groupBy('rapot')->pluck('c','rapot');
        $byWil = (clone $base)->selectRaw('wil, count(*) as c')->groupBy('wil')->pluck('c','wil');
        $byProv = (clone $base)->selectRaw('provinsi, count(*) as c')->groupBy('provinsi')->orderByDesc('c')->limit(5)->pluck('c','provinsi');

        $recent = (clone $base)->latest()->take(5)->get();
        // Tugas utama GT = penempatan Diterima terbaru (untuk biodata + pembimbing)
        $tugasUtama = $isGt ? (clone $base)->latest()->first() : null;
        // Antrian approve - only for admin
        $pending = $isAdmin ? Permohonan::where('status','Proses')->latest()->take(5)->get() : collect();
        // Top PJGT
        $topPjgt = Permohonan::selectRaw('pjgt_nama, username, count(*) as c')->groupBy('pjgt_nama','username')->orderByDesc('c')->limit(5)->get();
        // GT users
        $gtCount = \App\Models\User::where('role','gt')->count();
        $pjgtUserCount = \App\Models\User::where('role','pjgt')->count();

        return view('dashboard.index', compact(
            'total','proses','diterima','ditolak','butuhGt','madrasahDistinct','pjgtDistinct',
            'allTotal','allProses','byStatus','byRapot','byWil','byProv','recent','pending','topPjgt','gtCount','pjgtUserCount','isAdmin','isPjgt','isGt','tugasUtama'
        ));
    }
}
