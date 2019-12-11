@extends('layouts.masterlte')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
    <style type="text/css">
	.content-header {
        background: url('/storage/images/map-nganjuk.png');
        background-size: cover;
        padding: 0;
    }
	.section-1 {
		background-color: rgba(250,255,250,.3);
		padding: 35vh 0;
		margin: 0 auto;
	}
	.content-wrapper {
	}
	.logo-wrapper {
		text-align: center;
	}
</style>
@stop

@section('content_header')
	<div class="section-1">
		<div class="logo-wrapper">
			<img src="/storage/images/logo.png">
		</div>
	</div>
@stop

@section('content')
	<div class="section-2 bg-white my-3 py-3 container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center my-4">Lokasi Gudang</h2>
				<hr>
				<div id="MapLocation" style="height: 350px"></div>
			</div>
		</div>
	</div>
@stop

@section('footer')
<div class="container">
	2019&copy;gudangku.org
</div>
@endsection

@section('js')
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet@2.3.2/dist/esri-leaflet.js"
    integrity="sha512-6LVib9wGnqVKIClCduEwsCub7iauLXpwrd5njR2J507m3A2a4HXJDLMiSZzjcksag3UluIfuW1KzuWVI5n/cuQ=="
    crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@2.3.2/dist/esri-leaflet-geocoder.js"
    integrity="sha512-8twnXcrOGP3WfMvjB0jS5pNigFuIWj4ALwWEgxhZ+mxvjF5/FBPVd5uAxqT8dd2kUmTVK9+yQJ4CmTmSg/sXAQ=="
    crossorigin=""></script>
<script>
	$(function() {
        // use below if you want to specify the path for leaflet's images
        //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

        {{-- var curLocation = [{{$warehouse->latitude}}, {{$warehouse->longitude}}]; --}}
        // use below if you have a model
        // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

        // if ( curLocation == 0 ) {
            var curLocation = [-7.599398, 111.9676883];
        // }

        var map = L.map('MapLocation').setView(curLocation, 12);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.attributionControl.setPrefix(false);

        // var marker = new L.marker(curLocation);
        // L.esri.basemapLayer('Streets').addTo(map);

        var array = [];
        var myItems = JSON.parse(@json($arr));
        

		for (var i = 0; i < myItems.length; i++) {
		    var item = myItems[i];

		    marker = new L.marker([item.lat,item.lng]).bindPopup(item.company);

        	map.addLayer(marker);
		}

    });
</script>
@stop