<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {
	
	protected $table = 'departments';
	public $timestamps = false;
	protected $fillable = ['name'];
	
	public function users()
	{
		return $this->belongsToMany('\App\Http\Models\User', 'users_departments');
	}
	
}
