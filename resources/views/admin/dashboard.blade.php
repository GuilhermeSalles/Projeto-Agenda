@extends('admin.master')
@extends('admin.get-status-form')


@section('title', 'DashBoard')

@section('content')

<div class="section"><h1>Olá {{ auth()->user()->firstName }} {{ auth()->user()->lastName }} </h1></div>



@endsection