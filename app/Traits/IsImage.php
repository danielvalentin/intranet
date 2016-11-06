<?php namespace App\Traits;

use Illuminate\Http\Request;
use App\Traits\IsFile;

use App\Http\Models\Imageversion;

trait IsImage {
	
	use IsFile;
	
	public function getVersion($width, $height)
	{
		$newname = $this->getName().'-'.$width.'x'.$height.'.'.$this->getExtension();

		$existing = $this->versions()
			->where('width', '=', $width)
			->where('height', '=', $height)
			->first();
		if($existing)
		{
			return $existing;
		}
		
		$path = $this->getDirName().'/'.$this->filename;
		$img = \Image::make($path)
			->resize(120, 120);

		$version = new Imageversion();
		$version->image_id = $this->id;
		$version->width = 120;
		$version->height = 120;
		$version->filename = $newname;

		$img->save($this->getDirName().'/'.$newname);

		$version->size = filesize($this->getDirName().'/'.$version->filename);
		$version->save();

		return $version;
	}

	public function delete()
	{
		foreach($this->versions()->get() as $version)
		{
			$version->delete();
		}
		return parent::delete();
	}

}
