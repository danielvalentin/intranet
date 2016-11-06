<?php namespace App\Traits;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

trait AuthenticatesAndRegistersAppUsers {
	
	use AuthenticatesAndRegistersUsers;
	
	public function getLogout()
	{
		\Auth::logout();

		return redirect('/');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		if (\Auth::attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}

	public function loginPath()
	{
		return route('userLogin');
	}

	public function getRegister()
	{
		return view('auth.register');
	}
	
	public function getLogin()
	{
		return view('auth.login');
	}

}
