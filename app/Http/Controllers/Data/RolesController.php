<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;

use App\Http\Models\Role;
use App\Http\Models\User;

class RolesController extends \App\Http\Controllers\Controller
{

	public function get(Request $request)
	{
		$paginate = $request->input('limit', false);
		if($paginate)
		{
			$roles = Role::paginate($paginate);
		}
		else
		{
			$roles = Role::all();
		}
		$data = array();
		foreach($roles as $role)
		{
			$data[] = array(
				'id' => $role->id,
				'name' => $role->name
			);
		}
		return response()->json($data);
	}

	public function addUser(Request $request, $id)
	{
		$role = Role::findOrFail($id);
		$user = User::findOrFail($request->input('id'));
		$role->users()->attach($user);
		\Ajax::success('ok');
	}

	public function removeUser(Request $request, $id, $userid)
	{
		$role = Role::findOrFail($id);
		$user = User::findOrFail($userid);
		$role->users()->detach($user);
		\Ajax::success('ok');
	}

}
