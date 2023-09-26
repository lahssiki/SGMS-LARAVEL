<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityGuard extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'cin',
        'adresse',
        'image',
        'categorie'
    ];
}
