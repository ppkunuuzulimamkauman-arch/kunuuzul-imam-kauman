<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penempatan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gt()
    {
        return $this->belongsTo(User::class, 'gt_user_id');
    }

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }
}
