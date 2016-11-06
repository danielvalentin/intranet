<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {
	
	protected $table = 'addresses';
	protected $fillable = [
		'user_id',
		'client_id',
		'name',
		'address',
		'address2',
		'zip',
		'city',
		'country',
		'phone',
		'email',
		'notes'
	];
	
	public function user()
	{
		return $this->belongsTo('\App\Http\Models\User');
	}

	public function client()
	{
		return $this->belongsTo('\App\Http\Models\Client');
	}
	
}
