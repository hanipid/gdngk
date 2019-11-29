@extends('adminlte::page')

@section('title', 'Gudang | Tambah Data Komoditas')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Komoditas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form method="post" action="/commodities">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label">Kode</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="code" id="code" placeholder="Kode">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">Nama Komoditas</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" name="name" id="name" placeholder="Nama Komoditas">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rental_price" class="col-md-4 col-form-label">Harga Sewa (Kg)</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp. </span>
                                </div>
                                <input type="text" class="form-control" id="rental_price" name="rental_price" placeholder="Harga sewa per Kg">
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