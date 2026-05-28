<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Official extends Model { protected $fillable = ['name', 'position', 'type', 'organization', 'section', 'photo', 'birth_place_date', 'movement_focus', 'service_period', 'motto']; }
