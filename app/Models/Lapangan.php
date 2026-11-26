<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    protected $fillable = [
        'nama_lapangan',
        'jenis_olahraga',
        'jenis_lantai',
        'ukuran',
        'status_fisik'
    ];
}
