@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        You are logged in!
        <p>
			<?php var_dump(User::can('edit_departments')); ?>
        </p>
    </div>
</div>
@endsection
