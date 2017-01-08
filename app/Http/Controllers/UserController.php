<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Models\User;
use App\Http\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    return view('users.index', [
	    	'users' => User::paginate(15)
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create(Request $request)
	{
		$this->validate($request, array(
			'name' => 'required|max:100|min:1',
			'email' => 'required|email|unique:users|max:100',
			'password' => 'required|min:5|max:100'
		));
		$user = User::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'password' => bcrypt($request->input('password'))
		]);
		return redirect()
			->route('users.index')
			->with('success', $user->name.' oprettet.');
	}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', [
        	'user' => $user,
        	'roles' => $roles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    	//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
			'name' => 'required|max:100|min:1',
			'email' => [
				'required',
				Rule::unique('users')->ignore($user->id),
				'max:100'
			],
			'password' => 'sometimes|min:5|max:100'
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect()
        	->route('users.show', ['id' => $user->id])
        	->with('info', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()
			->route('users.index')
			->with(['info', 'User deleted']);
	}
}
