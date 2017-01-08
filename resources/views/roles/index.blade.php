@extends('layouts.app')

@section('content')

<?php
	\HTML::breadcrumb([
		'active' => 'Roles'
	]);
?>

<div class="page-header">
	<h2>Roles</h2>
</div>

<script>
	var roles = [];
	@foreach($roles as $role)
		role.push({
			id:{{ $role->id }},
			name:'{{ $role->name }}',
			email:'{{ $role->description }}',
		});
	@endforeach
</script>

<div id="roles"></div>

<div class="text-right">
	<a href="#add-role-form" data-toggle="collapse" aria-expanded="false" aria-controls="add-role-form">
		<span class="glyphicon glyphicon-plus"></span>
		Add role
	</a>
</div>
<div class="collapse" id="add-role-form">
	<form action="{{ route('roles.create') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="role-name">Name:</label>
			<input class="form-control" type="text" name="name" id="role-name" value="{{ old('name') }}" />
		</div>
		<div class="form-group">
			<label for="role-description">Description:</label>
			<textarea name="description" class="form-control" id="form-group">{{ old('description') }}</textarea>
		</div>
		<div class="text-right">
			<button class="btn btn-primary" type="submit">Add role</button>
		</div>
	</form>
</div>

<table class="table table-striped">
	<thead>
		<tr>
			<td>Name</td>
			<td>Description</td>
			<td>Users</td>
		</tr>
	</thead>
	<tbody>
		@foreach($roles as $role)
			<tr>
				<td><a href="/roles/{{ $role->id }}">{{ $role->name }}</a></td>
				<td>{{ $role->description }}</td>
				<td>{{ $role->users->count() }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

@endsection

