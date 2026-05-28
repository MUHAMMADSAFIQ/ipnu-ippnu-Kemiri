<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = [
        'organization',
        'section_title',
        'content',
        'order_num',
    ];
}
