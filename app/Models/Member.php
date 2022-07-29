<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;

    protected $table = 'member';
    protected $primaryKey = 'member_id';
    
    protected $fillable = [
        'member_id',
        'account',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
