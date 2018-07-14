<?php

namespace Login;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

	use SoftDeletes;

    protected $table    = 'roles';

    protected $fillable = ['name','description', 'status'];

	protected $dates    = ['deleted_at'];
    
	public function users(){
	return $this->belongsToMany('Login\User')
				->withTimestamps();
	}
}
