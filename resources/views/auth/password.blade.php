@extends('app')

@section('content')
@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Hov!</strong> Der var nogle problemer med din indtastning<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<form role="form" method="POST" action="{{ route('userForgotPasswordPost') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="form-group">
		<label class="control-label">E-Mail addresse:</label>
		<input type="email" class="form-control" placeholder="Din e-mail.." name="email" value="{{ old('email') }}">
	</div>

	<div class="form-group">
		<div class="">
			<button type="submit" class="btn btn-primary">
				Send password nulstil link
			</button>
		</div>
	</div>
</form>
@endsection
