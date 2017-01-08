<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Models\Role;
use App\Http\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
	    return view('roles.index', [
	    	'roles' => Role::paginate(15)
		]);
    }

    public function show(Request $request, $id)
    {
    	$role = Role::findOrFail($id);
    	$users = $role->users()->paginate(15);
	    $permissions = Permission::all();
	    $userpermissions = $role->permissions()->get(['id'])->toArray();
	    $up = array();
	    foreach($userpermissions as $userpermission)
	    {
	    	$up[] = $userpermission['id'];
	    }
    	return view('roles.edit', [
    		'role' => $role,
    		'users' => $users,
    		'permissions' => $permissions,
    		'userpermissions' => $up
    	]);
    }

    public function create(Request $request)
    {
	    $this->validate($request, [
			'name' => 'required|unique:roles|min:1|max:255',
	    	'description' => 'max:1500'
		]);
		Role::create([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);
		return redirect()
			->back()
			->with('success', 'Role created');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()
        	->route('roles.index')
        	->with('info', 'Role deleted');
    }

    public function update(Request $request, $id)
    {
	    $this->validate($request, [
	    	'name' => [
	    		'required',
	    		Rule::unique('roles')->ignore($id),
	    		'max:255'
	    	],
	    	'description' => 'max:2000'
		]);
		$role = Role::findOrFail($id);
		$role->update([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);
		$role->permissions()->detach();
		$permissions = $request->input('permission');
		$role->permissions()->attach($permissions);

		return redirect()
			->back()
			->with('success', 'Updated!');

    }

}
