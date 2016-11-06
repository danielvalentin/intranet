<?php namespace App\Traits;

use App\Http\Models\File;
use App\Exceptions\FileUploadException;

trait UploadsFiles {
	
	private $mime;
	private $file;
	private $numfiles;
	
	public function validateImageUpload()
	{
		if(!\Farmer::logged())
		{
 			throw new FileUploadException('fejl! du skal være logget ind for at uploade filer. venligst log ind og prøv igen.', 401);
		}
		$data = \Input::only([
			'id',
			'width',
			'height',
			'type'
		]);
		$rules = array(
			'id' => 'required|integer|min:1|max:100000',
			'width' => 'integer|min:10|max:10000',
			'height' => 'integer|min:10|max:10000',
			'type' => 'required|in:farm,product,logo'
		);
		$val = \Validator::make($data, $rules);
		if($val->fails())
		{
			throw new FileUploadException('Fejl! Ukorrekt data modtaget.', 400);
		}
		if(!\Request::hasFile('files'))
		{
			throw new FileUploadException('Fejl! Ingen filer modtaget.', 400);
		}

		$files = \Request::file('files');
		$this->numfiles = count($files);
		$this->file = \Request::file('files')[0];
		$this->mime = $this->file->getMimeType();
		$allowed = array(
			'image/jpeg',
			'image/png',
			'image/gif'
		);
		if(!in_array($this->mime, $allowed))
		{
			throw new FileUploadException('Kun billeder af typen jpeg, gif og png er tilladt.', 415);
		}
		return true;
	}

	public function uploadImage()
	{
		$ext = 'jpg';
		switch($this->mime)
		{
			case 'image/png':
				$ext = 'png';
				break;
			case 'image/gif':
				$ext = 'gif';
				break;
			case 'image/jpeg':
				$ext = 'jpg';
				break;
		}
		$name = str_random(20);
		$existing = File::where('filename','=', $name.'.'.$ext)->first();
		while($existing && $existing->exists)
		{
			$name = str_random(20);
			$existing = File::where('filename','=', $name.'.'.$ext)->first();
		}
		$this->file->move('media/uploads', $name.'.'.$ext);
		list($width, $height) = getimagesize('media/uploads/'.$name.'.'.$ext);
		$row = File::create([
			'filename' => $name,
			'ext' => $ext,
			'mime' => $this->mime,
			'width' => $width,
			'height' => $height,
			'type' => \Input::get('type')
		]);
		if($row)
		{
			return $row;
		}
		throw new FileUploadException(500, 'Kunne ikke gemme filen.');
	}

}

