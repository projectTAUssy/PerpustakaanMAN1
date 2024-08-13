<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RakBuku extends Model
{
    protected $primaryKey = 'nomor_rak';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nomor_rak',
        'nama_rak',
    ];

    // Pastikan $timestamps diatur sesuai kebutuhan
    public $timestamps = true;
}

