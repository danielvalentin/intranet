<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
	
	protected $table = 'permissions';
	public $timestamps = false;
	protected $fillable = ['name'];

	public function users()
	{
		return $this->belongsToMany('\App\Http\Models\User', 'users_roles');
	}

	public function roles()
	{
		return $this->belongsToMany('\App\Http\Models\Role', 'roles_permissions');
	}
	
}
