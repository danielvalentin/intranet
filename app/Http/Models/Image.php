<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\IsImage;

class Image extends Model {
	
	use IsImage;
	
	protected $table = 'images';
	public $timestamps = false;

	protected $fillable = [
		'recipe_id',
		'filename'
	];
	
	public function recipe()
	{
		return $this->belongsTo('App\Http\Models\Recipe');
	}

	public function versions()
	{
		return $this->hasMany('App\Http\Models\Imageversion');
	}

	
}
