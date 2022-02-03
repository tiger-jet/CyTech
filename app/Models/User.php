<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';

    //可変項目
    protected $fillable=
    [
        'user_name',
        'email',
        'password',
        'locked_flg',
        'error_count',
    ];

    protected $hidden=[
        'password',
    ];
}
