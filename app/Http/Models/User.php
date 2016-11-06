<?php namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function roles()
	{
		return $this->belongsToMany('App\Http\Models\Role', 'users_roles');
	}

	public function departments()
	{
		return $this->belongsToMany('App\Http\Models\Department', 'users_departments');
	}

	public function clients()
	{
		return $this->hasMany('App\Http\Models\Client');
	}

	public function addresses()
	{
		return $this->hasMany('App\Http\Models\Address');
	}

	public function hasRole($role = false)
	{
		if(!$role) return false;
		return (bool)$this->roles()->where('name','=',$role)->first();
	}
	
	public function assignRole($role)
	{
		if(gettype($role) == 'string')
		{
			$role = Role::whereName($role)->first();
		}
		return $this->roles()->attach($role);
	}
	
	public function possessiveName()
	{
		$name = $this->name;
		if(Str::endsWith($name,'s'))
		{
			$name .= "'";
		}
		else
		{
			$name .= "'s";
		}
		return $name;
	}
}
