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
                        <label for="user_id" class="col-md-4 col-form-label">Pemilik</label>
                        <div class="col-md-8">
                            <select class="form-control" name="user_id" id="user_id">
                                @foreach ($users as $user)
                                <option value="{{$user->id}}" @if($warehouse->user_id == $user->id) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employee_id" class="col-md-4 col-form-label">Petugas Gudang</label>
                        <div class="col-md-8">
                            <select class="form-control" name="employee_id" id="employee_id">
                                @foreach ($employees as $employee)
                                <option value="{{$employee->id}}" @if($warehouse->employee_id == $employee->id) selected @endif>{{$employee->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="number_date" class="col-md-4 col-form-label">Nomor / Tanggal TDG</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="number_date" id="number_date" placeholder="Nomor / Tanggal TDG" value="{{$warehouse->number_date}}">
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
                        <label for="warehouse_category_id" class="col-md-4 col-form-label">Kategori Gudang</label>
                        <div class="input-group col-md-8">
                            <select class="form-control" name="warehouse_category_id" id="warehouse_category_id">
                                @foreach ($warehouseCategories as $warehouseCategory)
                                <option value="{{$warehouseCategory->id}}" @if($warehouse->warehouse_category_id == $warehouseCategory->id) selected @endif>{{$warehouseCategory->name}}</option>
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
                        <label for="unit_area" class="col-md-4 col-form-label">Luas</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" id="unit_area" name="unit_area" placeholder="Luas" value="{{$warehouse->unit_area}}">
                            <div class="input-group-append">
                                <span class="input-group-text">m<sup>2</sup></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="district_id" class="col-md-4 col-form-label">Kecamatan</label>
                        <div class="input-group col-md-8">
                            <select class="form-control" name="district_id" id="district_id">
                                @foreach ($districts as $district)
                                <option value="{{$district->id}}" @if($warehouse->district_id == $district->id) selected @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="village_id" class="col-md-4 col-form-label">Desa</label>
                        <div class="input-group col-md-8">
                            <select class="form-control" name="village_id" id="village_id">
                                @foreach ($villages as $village)
                                <option value="{{$village->id}}" @if($warehouse->village_id == $village->id) selected @endif>{{$village->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label">Alamat</label>
                        <div class="input-group col-8">
                            <textarea class="form-control" name="address" id="address" placeholder="Alamat gudang">{{$warehouse->address}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="MapLocation" style="height: 350px"></div>
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

@section('css')
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.css">
<link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script type="text/javascript" src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>

<script>
$(document).ready(function () {
    bsCustomFileInput.init();
});

$(function() {
    // use below if you want to specify the path for leaflet's images
    //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

    var curLocation = [{{$warehouse->latitude}}, {{$warehouse->longitude}}];
    // use below if you have a model
    // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [-7.599398, 111.9676883];
    }

    var map = L.map('MapLocation').setView(curLocation, 14);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable: 'true'
    });

    function getPosition(e) {
        console.log(e.latlng);
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        var position = [parseInt(lat), parseInt(lng)];
        $("#latitude").val(lat);
        $("#longitude").val(lng);
        marker.setLatLng([lat,lng], {
            draggable: 'true'
        }).update();
    }

    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: 'true'
        }).update();
        $("#latitude").val(position.lat);
        $("#longitude").val(position.lng).keyup();
    });

    map.on('click', function(e) {
        getPosition(e);
    } );

    marker.on('click', function(e) {
        getPosition(e);
        console.log('marker');
    } );

    $("#latitude, #longitude").change(function() {
        var position = [parseInt($("#latitude").val()), parseInt($("#longitude").val())];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
    });

    var searchControl = new L.esri.Controls.Geosearch().addTo(map);
    var results = new L.LayerGroup().addTo(map);

    searchControl.on('results', function(data){
        results.clearLayers();
        for (var i = data.results.length - 1; i >= 0; i--) {
            // results.addLayer(L.marker(data.results[i].latlng));
            results.addLayer(marker.setLatLng(data.results[i].latlng, {
                draggable: 'true'
            }).update());
            $("#latitude").val(data.results[i].latlng.lat);
            $("#longitude").val(data.results[i].latlng.lng);
        }
    });

    map.addLayer(marker);
});
</script>
@stop