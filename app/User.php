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

    protected $fillable = ['name','email', 'username', 'password','profile','status'];

    protected $hidden   = ['password', 'remember_token'];

    protected $dates    = ['deleted_at'];

	
	public function roles(){
		return $this->belongsToMany('Login\Role')
					->withTimestamps();
	}

    public function authorizeRoles($roles){
        if ($this->hasAnyRole($roles)) {
        return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }


    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
             }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
    return false;
    }

}
