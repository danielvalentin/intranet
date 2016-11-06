<?php namespace App\Traits;

use Illuminate\Http\Request;

trait IsFile {
	
	public function delete()
	{
		unlink('media/recipes/'.$this->filename);
		return parent::delete();
	}

	public function getDirName()
	{
		return 'media/recipes';
	}

	public function path()
	{
		return '/media/recipes/'.$this->filename;
	}

	public function getNameParts()
	{
		return explode('.', $this->filename);
	}

	public function getExtension()
	{
		$parts = $this->getNameParts();
		return end($parts);
	}

	public function getName()
	{
		$parts = $this->getNameParts();
		(array)array_pop($parts);
		return implode('.', $parts);
	}

}
