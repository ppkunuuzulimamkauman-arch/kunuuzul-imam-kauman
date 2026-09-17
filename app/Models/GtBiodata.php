<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GtBiodata extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tgl_lahir_ayah' => 'date',
        'tgl_lahir_ibu' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
