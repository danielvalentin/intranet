<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Validation\AlphaNumSpaces;
use Illuminate\Support\Facades\Validator;

class ValidatorExtenderProvider extends ServiceProvider {
	
	public function boot()
	{
		Validator::resolver(function($translator, $data, $rules, $messages){
			return new AlphaNumSpaces($translator, $data, $rules, $messages);
		});
	}
	
	public function register()
	{
		
	}
	
}
