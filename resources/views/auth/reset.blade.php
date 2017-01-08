@extends('app')

@section('content')

<h2>Nulstil password</h2>

{{ \Site::checkMessages($errors) }}

<form role="form" method="POST" action="{{ route('user.resetPasswordPost') }}">
	{!! csrf_field() !!}
	<input type="hidden" name="token" value="{{ $token }}">

	<div class="form-group">
		<label for="reset-email">E-mail adresse:</label>
		<input type="email" id="reset-email" placeholder="Din e-mail.." class="form-control" name="email" value="{{ old('email') }}">
	</div>

	<div class="form-group">
		<label for="reset-password">Nyt password:</label>
		<input type="password" placeholder="Dit nye password.." id="reset-password" class="form-control" name="password">
	</div>

	<div class="form-group">
		<label for="reset-confirm">Bekræft password:</label>
		<input type="password" placeholder="Gentag dit nye password.." id="reset-confirm" class="form-control" name="password_confirmation">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">
			Reset Password
		</button>
	</div>
</form>

@endsection
