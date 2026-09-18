<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PjgtLaporanGt extends Model
{
    protected $fillable = [
        'pjgt_user_id','gt_user_id','tahun_ajaran','bulan','periode','nama_madrasah',
        'madrasiyah','kemasyarakatan','catatan_umum','status'
    ];

    protected $casts = [
        'madrasiyah' => 'array',
        'kemasyarakatan' => 'array',
    ];

    public const MADRASIYAH_INDIKATOR = [
        1 => 'Hadir tepat waktu',
        2 => 'Berpakaian rapi dan sopan',
        3 => 'Menyiapkan materi pembelajaran',
        4 => 'Membawa perangkat mengajar (kitab, buku, dll)',
        5 => 'Menunjukkan kesiapan mengajar',
        6 => 'Aktif dalam kegiatan madrasah',
    ];

    public const KEMASYARAKATAN_INDIKATOR = [
        1 => 'Mengikuti/memimpin kegiatan keagamaan',
        2 => 'Membimbing ngaji/TPQ/Madin',
        3 => 'Aktif dalam kegiatan masyarakat',
        4 => 'Menjadi teladan dalam akhlak',
        5 => 'Menjaga nama baik lembaga dan pondok',
    ];

    public const PILIHAN = ['Sangat Baik','Baik','Kurang'];

    public function pjgt(): BelongsTo { return $this->belongsTo(User::class, 'pjgt_user_id'); }
    public function gt(): BelongsTo { return $this->belongsTo(User::class, 'gt_user_id'); }
}
