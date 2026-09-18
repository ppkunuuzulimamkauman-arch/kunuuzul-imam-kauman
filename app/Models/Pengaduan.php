<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    protected $fillable = [
        'pjgt_user_id','gt_user_id','nama_madrasah','judul','kategori','deskripsi','tanggal_kejadian','status','tanggapan_admin',
        'status_pelapor','kontak_pelapor','nama_pelapor','nama_terlapor','tempat_tugas','lokasi','jenis_pelanggaran','kronologi','bukti_pendukung','bukti_foto_path','tindak_lanjut','tempat_tanggal'
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
    ];

    public const KATEGORI = ['Kesalahan','Pelanggaran','Kedisiplinan','Keterlambatan','Akhlak','Lainnya'];
    public const STATUS = ['Menunggu','Ditindaklanjuti','Selesai','Ditolak'];
    public const STATUS_PELAPOR = ['Masyarakat','Lembaga','SPGT','Lainnya'];
    public const JENIS_PELANGGARAN = ['Ringan','Sedang','Berat'];

    public function pjgt(): BelongsTo { return $this->belongsTo(User::class, 'pjgt_user_id'); }
    public function gt(): BelongsTo { return $this->belongsTo(User::class, 'gt_user_id'); }
}
