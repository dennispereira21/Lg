<?php

namespace Login;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $table    = 'users';

    protected $fillable = ['name','email', 'password','role','profile','status'];

    protected $hidden   = ['password', 'remember_token'];

    protected $dates    = ['deleted_at'];

}
