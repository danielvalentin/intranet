@extends('layouts.app')

@section('content')

<?php
	\HTML::breadcrumb([
		'Projects' => route('projects.index'),
		'active' => $project->name
	]);
?>

<div class="page-header">
	<h2>{{ $project->name }}</h2>
</div>

<div class="text-right togglebutton" data-title="Description" data-target="project-description"></div>
<div class="collapse" id="project-description">
	{!! HTML::markdown($project->description) !!}
</div>

@endsection

