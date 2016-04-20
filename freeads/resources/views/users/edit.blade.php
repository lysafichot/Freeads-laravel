@extends('index')

@section('title', 'Compte')

@section('head')
@parent

@stop


@section('sidebar')
@parent

@stop


@section('menu')
@parent

@stop

@section('content')
<div id='parent_content'>
 <div class="row">
 @foreach()

 @endforeach
</div>

</div>

@stop