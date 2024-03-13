<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'user_id',
        'materi_id',
        'code_id',
        'teaching_role',
        'date',
        'start',
        'end',
        'duration'
    ];

    public function code() 
    {
        return $this->hasOne(Code::class);
    }
}
