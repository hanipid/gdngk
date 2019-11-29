@extends('adminlte::page')

@section('title', 'Gudang | Data Komoditas')

@section('content_header')
    <h1 class="m-0 text-dark">Data Komoditas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-6 p-4">
                        <label>Nama Komoditas</label>
                        <h3>{{$commodity->name}}</h3>
                    </div>
                    <div class="col-6 p-4">
                        <label>Sewa</label>
                        <h3><span>@rupiah($commodity->rental_price)</span> per Kg</h3>
                    </div>
                </div>
            </div> {{-- /.card --}}
        </div> {{-- /.col-md-12 --}}
    </div> {{-- /.row --}}

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @includeIf('commodity.grade.index')
                </div>
            </div> {{-- /.card --}}
        </div> {{-- /.col-md-12 --}}
    </div> {{-- /.row --}}
@stop