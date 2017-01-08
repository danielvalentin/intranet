@extends('layouts.app')

@section('content')

<?php
	\HTML::breadcrumb([
		'Users' => route('users.index'),
		'active' => $user->name
	]);
?>

<div class="page-header">
	<h2>{{ $user->name }}</h2>
</div>

<form action="{{ route('users.update', ['id' => $user->id]) }}" method="post">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="user-name">Name:</label>
		<input class="form-control" type="text" name="name" id="user-name" value="{{ old('name', $user->name) }}" />
	</div>
	<div class="form-group">
		<label for="user-email">E-mail:</label>
		<input class="form-control" type="email" name="email" id="user-email" value="{{ old('email', $user->email) }}" />
	</div>
	<div class="form-group">
		<label for="user-password">Update password:</label>
		<input class="form-control" type="password" name="password" id="user-password" value="" />
	</div>
	<div class="text-right">
		<button class="btn btn-primary" type="submit">Save user</button>
	</div>
</form>

<hr />

<h3>User roles</h3>

<div id="user-roles">
	<script type="text/javascript" charset="utf-8">
		var userroles = [];
		@foreach($user->roles()->get() as $userrole)
			userroles.push({
				id:{{ $userrole->id }},
				name: '{{ $userrole->name }}'
			});
		@endforeach
		var allroles = [];
		@foreach($roles as $role)
			allroles.push({
				id:{{ $role->id }},
				name: '{{ $role->name }}'
			});
		@endforeach
	</script>
</div>

@endsection

