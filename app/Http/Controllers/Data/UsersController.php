<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;

use App\Http\Models\User;

class UsersController extends \App\Http\Controllers\Controller
{

	public function get(Request $request)
	{
		$paginate = $request->input('limit', false);
		if($paginate)
		{
			$users = User::paginate($paginate);
		}
		else
		{
			$users = User::all();
		}
		$data = array();
		foreach($users as $user)
		{
			$data[] = array(
				'id' => $user->id,
				'name' => $user->name
			);
		}
		return response()->json($data);
	}

}
