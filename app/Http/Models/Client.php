<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {
	
	protected $table = 'clients';
	protected $fillable = [
		'type',
		'name',
		'address',
		'address2',
		'zip',
		'city',
		'country',
		'cvr',
		'contactperson',
		'phone',
		'email',
		'notes'
	];
	
	public function user()
	{
		return $this->belongsTo('\App\Http\Models\User');
	}

	public function addresses()
	{
		return $this->hasMany('\App\Http\Models\Address');
	}
	
}
