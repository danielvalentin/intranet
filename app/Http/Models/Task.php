<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
	
	protected $table = 'tasks';
	protected $fillable = [
		'user_id',
		'list_id',
		'title',
		'description',
		'due'
	];
	
	public function creator()
	{
		return $this->belongsTo('\App\Http\Models\User', 'user_id');
	}

	public function list()
	{
		return $this->belongsTo('App\Http\Models\List');
	}

	public function department()
	{
		return $this->user->department;
	}

	public function users()
	{
		return $this->belongsToMany('App\Http\Models\User', 'tasks_users');
	}

}
