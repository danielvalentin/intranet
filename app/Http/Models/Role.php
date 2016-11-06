<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
	
	protected $table = 'roles';
	public $timestamps = false;
	protected $fillable = ['name', 'description'];
	
	public function users()
	{
		return $this->belongsToMany('\App\Http\Models\User', 'users_roles');
	}

	public function permissions()
	{
		return $this->belongsToMany('\App\Http\Models\Permission', 'roles_permissions');
	}
	
}
