@extends('adminlte::master')

@section('adminlte_css')
    <style type="text/css">
        .content-wrapper {
            margin-left: 0 !important;
        }
    </style>
    @stack('css')
    @yield('css')
@stop

@section('body')
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="/storage/images/logo-kotak.png" height="30" alt="Gudangku">
                    Gudangku
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="/home">Dashboard <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login <span class="sr-only">(current)</span></a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content-wrapper">
            <div class="container">
                <div class="content-header">
                    <div class="{{config('adminlte.classes_content_header', 'container-fluid')}}">
                        @yield('content_header')
                    </div>
                </div>

                <div class="content">
                    <div class="{{config('adminlte.classes_content', 'container-fluid')}}">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop