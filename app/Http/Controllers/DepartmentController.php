<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departments.index', [
        	'departments' => Department::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
	    $this->validate($request, [
			'name' => 'required|unique:departments|min:1|max:255',
	    	'description' => 'max:1500'
		]);
		Department::create([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);
		return redirect()
			->back()
			->with('success', 'Department created');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$department = Department::findOrFail($id);
        return view('departments.edit', [
        	'department' => $department,
        	'users' => $department->users()->paginate(15)
        ]);
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
	    $this->validate($request, [
	    	'name' => [
	    		'required',
	    		Rule::unique('departments')->ignore($id),
	    		'max:255'
	    	],
	    	'description' => 'max:2000'
		]);

		Department::findOrFail($id)->update([
			'name' => $request->input('name'),
			'description' => $request->input('description')
		]);

		return redirect()
			->back()
			->with('success', 'Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::destroy($id);

        return redirect()
        	->to('departments.index')
        	->with('info', 'Department deleted');
    }

    public function getUsers(Request $request, $id)
    {
    	$department = Department::findOrFail($id);
		$paginate = $request->input('limit', false);
		if($paginate)
		{
			$users = $department->users()->paginate($paginate);
		}
		else
		{
			$users = $department->users()->get();
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

    public function removeUser($id, $userid)
    {
    	$department = Department::findOrFail($id);
    	$department->users()->detach($userid);
    	return response()->json(['info', 'User removed']);
    }

    public function addUser(Request $request, $id)
    {
    	$department = Department::findOrFail($id);
    	$department->users()->attach($request->input('id'));
    	return response()->json(['info', 'User added']);
    }
}
