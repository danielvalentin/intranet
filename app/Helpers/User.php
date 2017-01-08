<?php namespace App\Helpers;

abstract class User {
	
	public static function logged($role = 'login')
	{
		if(!\Auth::check()) return false;

		return (bool)\Auth::user()->roles()->where('name','=',$role)->first();
	}

	public static function can($permission_slug)
	{
		if(!\Auth::check()) return false;

		$roles = \Auth::user()->roles()->get();
		foreach($roles as $role)
		{
			$yes = $role->whereHas('permissions', function($query) use ($permission_slug){
				$query->where('slug', '=', $permission_slug);
			})->first();
			if($yes)
			{
				return true;
			}
		}
		return false;
	}
	
}
