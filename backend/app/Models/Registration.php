<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birth_place',
        'birth_date',
        'education',
        'makesta_date',
        'address',
    ];

    protected $dates = ['birth_date', 'makesta_date'];
}
