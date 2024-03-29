<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_materi'
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
