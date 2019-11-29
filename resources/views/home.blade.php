@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                    {{-- {{ dd(menu('admin', '_json')) }} --}}
                </div>
            </div>
        </div>
    </div>
@stop
