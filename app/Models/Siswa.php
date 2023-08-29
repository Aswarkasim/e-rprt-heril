<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded  = [];

    function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    function kehadiran()
    {
        return $this->belongsTo(Kehadiran::class, 'nisn', 'nisn');
    }
}
