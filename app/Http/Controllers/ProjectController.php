<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Models\Project;

class ProjectController extends Controller {

	public function index()
	{
		$projects = Project::paginate(15);
		return view('projects.index', [
			'projects' => $projects
		]);
	}

	public function create(Request $request)
	{
		$this->validate($request, array(
			'name' => 'required|max:255|min:1',
			'description' => 'max:2250'
		));
		$project = Project::create([
			'name' => $request->input('name'),
			'user_id' => \Auth::user()->id,
			'description' => $request->input('description')
		]);
		return redirect()
			->route('projects.show', ['id' => $project->id])
			->with('success', $project->name . ' oprettet.');
	}

	public function show($id)
	{
		$project = Project::findOrFail($id);
		return view('projects.show', [
			'project' => $project
		]);
	}

}

