@extends('layouts.app')

@section('content')

<?php
	\HTML::breadcrumb([
		'active' => 'Departments'
	]);
?>

<div class="page-header"><h2>Departments</h2></div>

@if($departments)
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Users</th>
			</tr>
		</thead>
		@foreach ($departments as $department)
			<tr>
				<td><a href="{{ url('/departments/'.$department->id) }}">{{ $department->name }}</a></td>
				<td>{{ $department->users()->count() }}</td>
			</tr>
		@endforeach
	</table>
@endif

<div class="text-right">
	<a href="#department-add-form" data-toggle="collapse" aria-expanded="false" aria-controls="department-add-form">
		<span class="glyphicon glyphicon-plus"></span>
		Add department
	</a>
</div>
<div class="collapse" id="department-add-form">
	<form action="{{ route('departments.create') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="department-name">Name:</label>
			<input class="form-control" type="text" name="name" id="department-name" value="{{ old('name') }}" />
		</div>
		<div class="form-group">
			<label for="department-description">Description:</label>
			<textarea name="description" class="form-control" id="department-description">{{ old('description') }}</textarea>
		</div>
		<div>
			<button class="btn btn-primary" type="submit">Save</button>
		</div>
	</form>
</div>
	
@endsection

