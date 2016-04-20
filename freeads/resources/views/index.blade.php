<!DOCTYPE html>
<html>
<head>
	<title>Freeads - @yield('title')</title>
	@section('head')
	<meta name="_token" content="{!! csrf_token() !!}"/>

	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
	{!!Html::style('css/home.css')!!}
	@show

</head>
<body>
	<header id='header'>
		<div id='open'>
			{{ HTML::image('image/bars.png', 'burger', array('id' => 'burger')) }}
		</div>
		<span>Hello {{ $session->username }} </span>

		{!! Form::open(array('url' => 'logout', 'id' => 'logout')) !!}
		<label>
			{{ Form::submit("Logout", ['name' =>'submit_logout','id' => 'submit_logout']) }}
			{{ HTML::image('image/logout.png') }}
		</label>
		{!! Form::close() !!}
	</header>
	<div id='container'>
		@if (Session::has('authorized'))
		<div class="alert alert-info">{{ Session::get('authorized') }}</div>
		@endif
		@section('sidebar')
		<nav id= 'nav'>
			<<div class='menu'>
			{{ link_to_route('profil', 'Profil', [$session->user_id], array('class'=>'')) }}
		</div>
		<div class='menu'>
			{{ link_to_route('account', 'Account', [$session->user_id], array('class'=>'')) }}
		</div>
		<div class='menu'>
		</div>
		<div class='menu'>
		</div>
	</nav>

	@show
	<div id='content'>
		@section('menu')

		@show

		@yield('content')

	</div>
</div>
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});
</script>
{!!Html::script('js/home.js')!!}
@show


</body>
</html>
