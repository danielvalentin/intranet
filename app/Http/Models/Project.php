<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
	
	protected $table = 'projects';
	protected $fillable = [
		'user_id',
		'name',
		'description'
	];
	
	public function owner()
	{
		return $this->belongsTo('\App\Http\Models\User', 'user_id');
	}

	public function lists()
	{
		return $this->belongsToMany('App\Http\Models\List', 'projects_lists');
	}

	public function users()
	{
		return $this->belongsToMany('App\Http\Models\User', 'users_projects');
	}

	public function tasks()
	{
		return $this->hasManyThrough('App\Http\Models\Task', 'App\Http\Models\List');
	}

}
