<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeeklyPlanning extends Model
{
        protected $fillable = [
        'security_guard_id',
        'week_start',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

     public function securityGuard()
    {
        return $this->belongsTo(SecurityGuard::class, 'security_guard_id');
    }
    
}
