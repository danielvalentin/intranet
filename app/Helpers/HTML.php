<?php namespace App\Helpers;

class HTML {

	public static function img($path, $class = '', $alt = '', $title = '')
	{
		return '<img src="'.$path.'" class="'.$class.'" alt="'.$alt.'" title="'.$title.'" />';
	}

	public static function link($destination, $name = false, $title = false, $class = '', $newWindow = false)
	{
		return '<a href="'.$destination.'" class="'.$class.'" title="'.($title?$title:($name?$name:'')).'"'.($newWindow?' target="_blank"':'').'>'.($name?$name:$destination).'</a>';
	}

}

