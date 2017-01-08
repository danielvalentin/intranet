<?php namespace App\Helpers;

abstract class Site {
	
	public static function redirect($route = 'frontpage', $parameters = array(), $hash = '')
	{
		$to = route($route, $parameters).$hash;
		return redirect($to);
	}
	
	public static function route($parts = '')
	{
		$path = 'routes';
		if(!is_array($parts))
		{
			$parts = explode('.',$parts);
		}
		if(!empty($parts)) foreach($parts as $part)
		{
			$path .= '.'.$part;
		}
		return trans($path);
	}

	public static function excerpt($content, $character_limit = 150)
	{
		$content = strip_tags($content);
		if(strlen($content) < $character_limit)
		{
			return $content;
		}
		$excerpt = substr($content, 0, $character_limit);
		$spaceposition = strrpos($excerpt, " ");
		if($spaceposition > 0)
		{
			$excerpt = substr($excerpt, 0, $spaceposition);
		}
		if(strlen($excerpt) < strlen($content))
		{
			$excerpt .= ' &hellip;';
		}
		return $excerpt;
	}

	public static function checkMessages($errors = array())
	{
		self::checkErrors($errors);
		self::checkInfo();
		self::checkSuccess();
	}
	
	public static function checkInfo()
	{
		if(\Session::has('info'))
		{
			echo '<div class="alert alert-info">';
			echo \Session::get('info');
			echo '</div>';
		}
	}

	public static function checkSuccess()
	{
		if(\Session::has('success'))
		{
			echo '<div class="alert alert-success">';
			echo \Session::get('success');
			echo '</div>';
		}
	}

	public static function checkErrors($errors = array())
	{
		if(\Session::has('error'))
		{
			echo '<div class="alert alert-danger">';
			echo \Session::get('error');
			echo '</div>';
		}
		if((bool)count($errors))
		{
			echo '<div class="alert alert-danger">';
			echo '<strong>Hov!</strong> Der var nogle problemer med din indtastning.<br><br>';
			echo '<ul>';
			foreach($errors->all() as $error)
			{
				echo '<li>'.$error.'</li>';
			}
			echo '</ul>';
			echo '</div>';
		}
	}

	public static function reservedNames()
	{
		$names = [
			'logind',
			'logout',
			'tilmeld',
			'glemt-password',
			'admin',
			'detersundt'
		];
		return implode(',', $names);
	}

	public static function slugify(Illuminate\Database\Eloquent\Model $model, $name = '')
	{
		$slug = slugify($name);
		$orgslug = $slug;
		$counter = 2;
		$existing = $model::where('slug', '=', $slug);
		while($existing)
		{
			$slug = $orgslug . '-' . $counter;
			$counter++;
		}
		return $slug;
	}

}
