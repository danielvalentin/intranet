<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class List extends Model {
	
	protected $table = 'lists';
	protected $fillable = [
		'user_id',
		'department_id',
		'name',
		'notes',
		'due'
	];
	
	public function owner()
	{
		return $this->belongsTo('\App\Http\Models\User', 'user_id');
	}

	public function department()
	{
		return $this->belongsTo('\App\Http\Models\Department');
	}

	public function orders()
	{
		return $this->belongsToMany('App\Http\Models\Order', 'orders_lists');
	}

	public function users()
	{
		return $this->belongsToMany('App\Http\Models\User', 'lists_users');
	}

	public function projects()
	{
		return $this->belongsToMany('App\Http\Models\Project', 'projects_lists');
	}
	
}
