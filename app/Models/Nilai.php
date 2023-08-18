<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $guarded;

    function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
