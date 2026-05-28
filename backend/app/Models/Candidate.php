<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'photo', 'vision', 'mission', 'votes_count', 'is_active', 'order', 'nomor_urut', 'asal_ranting', 'jabatan_sebelumnya', 'jenis_kelamin', 'angkatan'];
}
