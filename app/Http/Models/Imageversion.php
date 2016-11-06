<?php namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\IsFile;

class Imageversion extends Model {

	use IsFile;
	
	protected $table = 'imageversions';
	public $timestamps = false;

	protected $fillable = [
		'image_id',
		'width',
		'height',
		'filename'
	];
	
	public function image()
	{
		return $this->belongsTo('App\Http\Models\Image');
	}

}
