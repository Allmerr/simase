@extends('adminlte::page')

@section('title', 'SIMASE | Dashboard')

@section('content_header')
    <h1 class="m-0">Selamat datang {{ auth()->user()->nama_lengkap }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Welcome back!!</h3>
    </div>
</div>
@stop
