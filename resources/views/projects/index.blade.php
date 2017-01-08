@extends('layouts.app')

@section('content')

<?php
	\HTML::breadcrumb([
		'active' => 'Projects'
	]);
?>

<div class="page-header">
	<h2>Projects</h2>
</div>

<div class="text-right">
	<a href="#add-project-form" data-toggle="collapse" aria-expanded="false" aria-controls="add-project-form">
		<span class="glyphicon glyphicon-plus"></span>
		Add project
	</a>
</div>
<div class="collapse" id="add-project-form">
	<form action="{{ route('projects.create') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="project-name">Name:</label>
			<input class="form-control" type="text" name="name" id="project-name" value="{{ old('name') }}" />
		</div>
		<div class="form-group">
			<label for="project-description">Description:</label>
			<textarea name="description" class="form-control" id="form-group">{{ old('description') }}</textarea>
		</div>
		<div class="text-right">
			<button class="btn btn-primary" type="submit">Create project</button>
		</div>
	</form>
	<hr />
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<td>Name</td>
			<td>Description</td>
		</tr>
	</thead>
	<tbody>
		@foreach($projects as $project)
			<tr>
				<td><a href="/projects/{{ $project->id }}">{{ $project->name }}</a></td>
				<td>{{ $project->description }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection

