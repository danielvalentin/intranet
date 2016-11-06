<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	
	protected $table = 'orders';
	protected $fillable = [
		'user_id',
		'client_id',
		'invoiceNumber',
		'economicInvoiceNumber',
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
