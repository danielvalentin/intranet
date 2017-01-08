@extends('layouts.app')

@section('content')

<?php
	\HTML::breadcrumb([
		'Departments' => route('departments.index'),
		'active' => $department->name
	]);
?>

<div class="page-header">
	<h2>{{ $department->name }}</h2>
</div>

<div class="text-right">
	<a href="#department-edit-form" data-toggle="collapse" aria-expanded="false" aria-controls="department-edit-form">
		<span class="glyphicon glyphicon-pencil"></span>
		Edit department
	</a>
</div>
<div class="collapse" id="department-edit-form">
	<form action="{{ route('departments.update', ['id' => $department->id]) }}" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="department-name">Name:</label>
			<input class="form-control" type="text" name="name" id="department-name" value="{{ old('name', $department->name) }}" />
		</div>
		<div class="form-group">
			<label for="department-description">Description:</label>
			<textarea name="description" class="form-control" id="department-description">{{ old('description', $department->description) }}</textarea>
		</div>
		<div class="text-right">
			<button class="btn btn-primary" type="submit">Save</button>
			or <a href="{{ url('/departments/'.$department->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this department?');" class="danger">delete</a>
		</div>
	</form>
	<hr />
</div>

<script>
	var users = [];
	@foreach($users as $user)
		users.push({
			id:{{ $user->id }},
			name:'{{ $user->name }}'
		});
	@endforeach
</script>
<div id="department-users" data-department="{{ $department->id }}"></div>

<div class="text-right">
	<?php echo $users; ?>
</div>

@endsection

