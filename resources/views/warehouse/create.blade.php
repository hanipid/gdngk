@extends('adminlte::page')
@section('title', 'Gudang | Tambah Data Gudang')
@section('content_header')
<h1 class="m-0 text-dark">Tambah Data Gudang</h1>
@stop
@section('content')
<form method="post" action="/warehouses" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-6">
        <div class="card">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_id" class="col-md-4 col-form-label">Pemilik</label>
                        <div class="col-md-8">
                            <select class="form-control" name="user_id" id="user_id">
                                @foreach ($users as $user)
                                <option value="{{$user->id}}" @if(old('user_id') == $user->id) selected @endif>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employee_id" class="col-md-4 col-form-label">Petugas Gudang</label>
                        <div class="col-md-8">
                            <select class="form-control" name="employee_id" id="employee_id">
                                @foreach ($employees as $employee)
                                <option value="{{$employee->id}}" @if(old('employee_id') == $employee->id) selected @endif>{{$employee->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomor_tanggal" class="col-md-4 col-form-label">Nomor / Tanggal TDG</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="nomor_tanggal" id="nomor_tanggal" placeholder="Koordinat" value="{{old('nomor_tanggal')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="commodity_id" class="col-md-4 col-form-label">Komoditas</label>
                        <div class="input-group col-md-8">
                            <select class="form-control" name="commodity_id" id="commodity_id">
                                @foreach ($commodities as $commodity)
                                <option value="{{$commodity->id}}" @if(old('commodity_id') == $commodity->id) selected @endif>{{$commodity->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="warehouse_category_id" class="col-md-4 col-form-label">Kategori Gudang</label>
                        <div class="input-group col-md-8">
                            <select class="form-control" name="warehouse_category_id" id="warehouse_category_id">
                                @foreach ($warehouseCategories as $warehouseCategory)
                                <option value="{{$warehouseCategory->id}}" @if(old('warehouse_category_id') == $warehouseCategory->id) selected @endif>{{$warehouseCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="capacity" class="col-md-4 col-form-label">Kapasitas</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" placeholder="Kapasitas" value="{{old('capacity')}}">
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
                            <input type="text" class="form-control" id="unit_area" name="unit_area" placeholder="Luas" value="{{old('unit_area')}}">
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
                                <option value="{{$district->id}}" @if(old('district_id') == $district->id) selected @endif>{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="village_id" class="col-md-4 col-form-label">Desa</label>
                        <div class="input-group col-md-8">
                            <select class="form-control" name="village_id" id="village_id">
                                @foreach ($villages as $village)
                                <option value="{{$village->id}}" @if(old('village_id') == $village->id) selected @endif>{{$village->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label">Alamat</label>
                        <div class="input-group col-8">
                            <textarea class="form-control" name="address" id="address" placeholder="Alamat gudang" value="{{old('address')}}"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div id="myMap"></div>
                    </div>
                    <div class="form-group row">
                        <label for="latitude" class="col-md-4 col-form-label">Latitude</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Koordinat" value="{{old('latitude')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="longitude" class="col-md-4 col-form-label">Longitude</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Koordinat" value="{{old('longitude')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="information" class="col-md-4 col-form-label">Keterangan</label>
                        <div class="input-group col-8">
                            <textarea class="form-control" name="information" id="information" placeholder="Keterangan"> {{old('information')}} </textarea>
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
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="photo" name="photo">
                            <label class="custom-file-label" for="photo">Pilih foto</label>
                        </div>
                    </div>
                    <div id="map"></div>
                </div> {{-- /.form-group --}}
            </div> {{-- /.card-body --}}
        </div> {{-- /.card --}}
    </div> {{-- /.col-md-6 --}}
</div> {{-- /.row --}}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div> {{-- /.card-footer --}}
        </div>
    </div>
</div>
</form>
@stop

@section('css')
<style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?v=AIzaSyDAl6lMnNcTXCPiiIzUrK-qvCMFPxzjIYA&sensor=false"> --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAl6lMnNcTXCPiiIzUrK-qvCMFPxzjIYA"
  type="text/javascript"></script>
</script>
<script>
$(document).ready(function () {
bsCustomFileInput.init();
});
initMap();
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: -25.344, lng: 131.036};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
// var map;
// var marker;
// var myLatlng = new google.maps.LatLng(20.268455824834792,85.84099235520011);
// var geocoder = new google.maps.Geocoder();
// var infowindow = new google.maps.InfoWindow();
// function initialize(){
//     var mapOptions = {
//         zoom: 18,
//         center: myLatlng,
//         mapTypeId: google.maps.MapTypeId.ROADMAP
//     };

//     map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

//     marker = new google.maps.Marker({
//         map: map,
//         position: myLatlng,
//         draggable: true 
//     }); 

//     geocoder.geocode({'latLng': myLatlng }, function(results, status) {
//         if (status == google.maps.GeocoderStatus.OK) {
//             if (results[0]) {
//                 $('#latitude,#longitude').show();
//                 $('#address').val(results[0].formatted_address);
//                 $('#latitude').val(marker.getPosition().lat());
//                 $('#longitude').val(marker.getPosition().lng());
//                 infowindow.setContent(results[0].formatted_address);
//                 infowindow.open(map, marker);
//             }
//         }
//     });

//     google.maps.event.addListener(marker, 'dragend', function() {

//         geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
//             if (status == google.maps.GeocoderStatus.OK) {
//                 if (results[0]) {
//                     $('#address').val(results[0].formatted_address);
//                     $('#latitude').val(marker.getPosition().lat());
//                     $('#longitude').val(marker.getPosition().lng());
//                     infowindow.setContent(results[0].formatted_address);
//                     infowindow.open(map, marker);
//                 }
//             }
//         });
//     });

// }
// google.maps.event.addDomListener(window, 'load', initialize);
</script>
@stop