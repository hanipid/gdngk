@extends('adminlte::page')

@section('title', 'Gudang | Tambah Data Kelas Komoditas')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Kelas Komoditas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form method="post" action="/commodities/{{$commodityId}}/grades">
                    @csrf
                    <input type="hidden" name="commodity_id" value="{{$commodityId}}">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">Kelas</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Kelas X" value="{{old('name')}}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label">Harga Hari Ini</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control ribuan @error('price') is-invalid @enderror" id="price" name="price" placeholder="Harga Hari Ini" value="{{old('price')}}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> {{-- /.card-body --}}
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div> {{-- /.card-footer --}}
                </form>
            </div> {{-- /.card --}}
        </div> {{-- /.col-md-6 --}}
    </div> {{-- /.row --}}
@stop

@include('partials.thousandjs')