<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas', 'tingkat', 'fakultas', 'jurusan'
    ];


    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
