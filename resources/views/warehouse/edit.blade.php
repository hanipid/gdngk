@extends('adminlte::page')
@section('title', 'Gudang | Tambah Data Gudang')
@section('content_header')
<h1 class="m-0 text-dark">Tambah Data Gudang</h1>
@stop
@section('content')
<form method="post" action="/warehouses/{{$warehouse->id}}" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-6">
        <div class="card">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_id" class="col-md-4 col-form-label">Nama Pemilik</label>
                        <div class="col-md-8">
                            <select class="form-control" name="user_id" id="user_id">
                                @foreach ($users as $user)
                                <option value="{{$user->id}}" @if($warehouse->user_id == $user->id) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="commodity_id" class="col-md-4 col-form-label">Komoditas</label>
                        <div class="input-group col-md-8">
                            <select class="form-control" name="commodity_id" id="commodity_id">
                                @foreach ($commodities as $commodity)
                                <option value="{{$commodity->id}}" @if($warehouse->commodity_id == $commodity->id) selected @endif>{{$commodity->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="capacity" class="col-md-4 col-form-label">Kapasitas</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" placeholder="Kapasitas" value="{{$warehouse->capacity/1000}}">
                            <div class="input-group-append">
                                <span class="input-group-text">Ton</span>
                            </div>
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label">Alamat</label>
                        <div class="input-group col-8">
                            <textarea class="form-control" name="address" id="address" placeholder="Alamat gudang">{{$warehouse->address}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kecamatan" class="col-md-4 col-form-label">Kecamatan</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="kecamatan" id="kecamatan" placeholder="Kecamatan gudang" value="{{$warehouse->kecamatan}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desa" class="col-md-4 col-form-label">Desa</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="desa" id="desa" placeholder="Desa gudang" value="{{$warehouse->desa}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="latitude" class="col-md-4 col-form-label">Latitude</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Koordinat" value="{{$warehouse->latitude}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="longitude" class="col-md-4 col-form-label">Longitude</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Koordinat" value="{{$warehouse->longitude}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="information" class="col-md-4 col-form-label">Keterangan</label>
                        <div class="input-group col-8">
                            <textarea class="form-control" name="information" id="information" placeholder="Keterangan"> {{$warehouse->information}} </textarea>
                        </div>
                    </div>
                </div> {{-- /.card-body --}}
        </div> {{-- /.card --}}
    </div> {{-- /.col-md-6 --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="photo">Foto</label>
                    <hr>
                    <div class="text-center mb-3">
                        <img src="{{url('/storage/'.$warehouse->photo)}}" class="img-fluid">
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo" name="photo">
                            <label class="custom-file-label" for="photo">Pilih foto</label>
                        </div>
                    </div>
                </div> {{-- /.form-group --}}
            </div> {{-- /.card-body --}}
        </div> {{-- /.card --}}
    </div> {{-- /.col-md-6 --}}
</div> {{-- /.row --}}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-right">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div> {{-- /.card-footer --}}
        </div>
    </div>
</div>
</form>
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
$(document).ready(function () {
bsCustomFileInput.init();
});
</script>
@stop