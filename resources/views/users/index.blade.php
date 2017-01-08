@extends('layouts.app')

@section('content')

<?php
	\HTML::breadcrumb([
		'active' => 'Users'
	]);
?>

<div class="page-header">
	<h2>Users</h2>
</div>

<script>
	var users = [];
	@foreach($users as $user)
		users.push({
			id:{{ $user->id }},
			name:'{{ $user->name }}',
			email:'{{ $user->email }}',
			created:'{{ $user->created_at }}',
			logins:{{ (int)$user->logins }},
			lastLogin:{{ (int)$user->last_login }}
		});
	@endforeach
</script>

<div id="users"></div>

<div class="text-right">
	<a href="#add-user-form" data-toggle="collapse" aria-expanded="false" aria-controls="add-user-form">
		<span class="glyphicon glyphicon-plus"></span>
		Add user
	</a>
</div>
<div class="collapse" id="add-user-form">
	<form action="{{ route('users.create') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="user-name">Name:</label>
			<input class="form-control" type="text" name="name" id="user-name" value="{{ old('name') }}" />
		</div>
		<div class="form-group">
			<label for="user-email">E-mail:</label>
			<input class="form-control" type="email" name="email" id="user-email" value="{{ old('email') }}" />
		</div>
		<div class="form-group">
			<label for="user-password">Password:</label>
			<input class="form-control" type="password" name="password" id="user-password" value="" />
		</div>
		<div class="text-right">
			<button class="btn btn-primary" type="submit">Add user</button>
		</div>
	</form>
</div>

@endsection

