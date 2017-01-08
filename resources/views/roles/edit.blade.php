@extends('layouts.app')

@section('content')

<?php
	\HTML::breadcrumb([
		'Roles' => route('roles.index'),
		'active' => $role->name
	]);
?>

<div class="page-header">
	<h2>{{ $role->name }}</h2>
</div>

<form action="{{ route('roles.update', ['id' => $role->id]) }}" method="post">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="role-name">Name:</label>
		<input class="form-control" type="text" name="name" id="role-name" value="{{ old('name', $role->name) }}" />
	</div>
	<div class="form-group">
		<label for="role-description">Description:</label>
		<textarea name="description" class="form-control" id="role-description">{{ old('description', $role->description) }}</textarea>
	</div>
	<h3>Permissions</h3>
	<ul id="role-permissions" class="nav">
		@foreach($permissions as $permission)
			<li>
				<label>
					<input type="checkbox" name="permission[]" value="{{ $permission->id }}"<?php echo (in_array($permission->id, $userpermissions)?' checked="checked"':'') ?> /> {{ $permission->name }}
				</label>
			</li>
		@endforeach
	</ul>
	<div class="text-right">
		<button class="btn btn-primary" type="submit">Save</button>
		or <a href="{{ url('/roles/'.$role->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this role?');" class="danger">delete</a>
	</div>
</form>

<hr />
	
<script>
	var users = [];
	@foreach($users as $user)
		users.push({
			id:{{ $user->id }},
			name:'{{ $user->name }}'
		});
	@endforeach
</script>
<div id="role-users" data-role="{{ $role->id }}"></div>

<div class="text-right">
	<?php echo $users; ?>
</div>

@endsection

