<?php namespace App\Helpers;

use Michelf\Markdown;

class HTML {

	public static function markdown($text = '')
	{
		return Markdown::defaultTransform($text);
	}

	public static function img($path, $class = '', $alt = '', $title = '')
	{
		return '<img src="'.$path.'" class="'.$class.'" alt="'.$alt.'" title="'.$title.'" />';
	}

	public static function link($destination, $name = false, $title = false, $class = '', $newWindow = false)
	{
		return '<a href="'.$destination.'" class="'.$class.'" title="'.($title?$title:($name?$name:'')).'"'.($newWindow?' target="_blank"':'').'>'.($name?$name:$destination).'</a>';
	}

	public static function breadcrumb($routes)
	{
    	$html = '<ol class="breadcrumb">';
    	$html .= '<li><a href="'.route('home').'">Home</a></li>';
    	foreach($routes as $name => $url)
    	{
    		if($name != 'active')
    		{
    			$html .= '<li><a href="'.$url.'">'.$name.'</a></li>';
    		}
    	}
    	$html .= '<li class="active">'.$routes['active'].'</li>';
    	$html .= '</ol>';
		echo $html;
	}

}

