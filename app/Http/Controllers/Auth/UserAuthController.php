<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\AuthenticatesAndRegistersAppUsers;
use App\Http\Models\User;
use Auth;

class UserAuthController extends Controller {
	
	//protected $redirectTo = 'home';
	
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersAppUsers;
	
	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	public function redirectPath()
	{
		return route('home');
	}
	
	public function validator(array $data)
	{
		return \Validator::make($data, [
			'name' => 'required|max:30|min:2|alpha_dash_spaces|unique:users|not_in:marktilbord,signup,home,shop,updates,account,admin,'.\Site::reservedNames(),
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
		if($user)
		{
			$user->assignRole('login');
		}
		return $user;
	}

}
