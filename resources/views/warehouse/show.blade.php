@extends('adminlte::page')
@section('title', 'Detail Gudang')
@section('content_header')
<h1 class="m-0 text-dark">
<i class="fa fa-warehouse"></i> Detail Gudang
</h1>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Gudang {{ucfirst($warehouse->commodity->name)}}</h5>
                <div class="card-tools">
                    <h5 class="card-title">{{ucfirst($warehouse->user->name)}} <small><strong>{{ucfirst($warehouse->user->company)}}</strong></small></h5>
                </div>
            </div>
            <div class="card-body table-responsive">
                <div class="card card-success card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-history-tab" data-toggle="pill" href="#custom-tabs-three-history" role="tab" aria-controls="custom-tabs-three-history" aria-selected="false">Riwayat Barang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-acounting-tab" data-toggle="pill" href="#custom-tabs-three-acounting" role="tab" aria-controls="custom-tabs-three-acounting" aria-selected="false">Keuangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Profile</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4>Total Barang</h4>
                                                <h5>{{$warehouse->capacity / 1000}} Ton</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4>Total Nominal</h4>
                                                <h5>Rp. </h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4>Sewa Gudang Per Kg</h4>
                                                <h5>@rupiah($warehouse->commodity->rental_price)</h5>
                                            </div>
                                        </div>                                                
                                    </div>
                                </div> {{-- /.row --}}

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-inline my-2 py-2 float-right">
                                            <div class="form-group mx-2">
                                                <label>Filter: </label>
                                                <select class="form-control mx-2" id="filter-field">
                                                    <option value="kelas">Kelas</option>
                                                </select>
                                            </div>
                                            <div class="form-group mx-2">
                                                <label>Kata Kunci: </label>
                                                <select class="form-control mx-2" id="filter-value">
                                                    <option value="">Semua</option>
                                                    <option value="A">Kelas A</option>
                                                    <option value="B">Kelas B</option>
                                                    <option value="C">Kelas C</option>
                                                </select>
                                            </div>
                                            <button id="filter-clear" class="btn btn-outline-primary">Clear</button>
                                        </div>
                                        <table id="kelas" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="80">Kelas</th>
                                                    <th width="120">Tanggal Masuk</th>
                                                    <th>No. Resi</th>
                                                    <th>Petani</th>
                                                    <th>Jumlah Berat</th>
                                                    <th>Harga Modal</th>
                                                    <th>Jumlah Harga</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> {{-- /.tab-pane --}}
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <label for="user_id" class="col-md-4">Nama Pemilik</label>
                                                        <div class="col-md-8">
                                                            {{$warehouse->user->name}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="user_id" class="col-md-4">Nama Petugas</label>
                                                        <div class="col-md-8">
                                                            {{$warehouse->employee->name}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="commodity_id" class="col-md-4">Nomor / Tanggal TDG</label>
                                                        <div class="col-md-8">
                                                            {{$warehouse->number_date}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="commodity_id" class="col-md-4">Komoditas</label>
                                                        <div class="col-md-8">
                                                            {{$warehouse->commodity->name}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-md-4">Kategori Gudang</label>
                                                        <div class="col-md-8">
                                                            {{$warehouse->warehouseCategory->name}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="capacity" class="col-md-4">Kapasitas</label>
                                                        <div class="col-8">
                                                            {{$warehouse->capacity/1000}} Ton
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-md-4">Luas</label>
                                                        <div class="col-md-8">
                                                            {{$warehouse->unit_area}} m<sup>2</sup>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="address" class="col-md-4">Alamat</label>
                                                        <div class="col-8">
                                                            {{$warehouse->address}} Desa {{ ucfirst($warehouse->village->name) }} Kecamatan {{ ucfirst($warehouse->district->name) }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-md-4">Peta</label>
                                                        <div class="col-md-8">
                                                            <div id="MapLocation" style="height: 350px"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="information" class="col-md-4">Keterangan</label>
                                                        <div class="col-8">
                                                            {{$warehouse->information}}
                                                        </div>
                                                    </div>
                                                </div> {{-- /.card-body --}}
                                        </div> {{-- /.card --}}
                                    </div> {{-- /.col-md-6 --}}
                                    <div class="col-md-5">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="text-center mb-3">
                                                        <img src="{{url('/storage/'.$warehouse->photo)}}" class="img-fluid">
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
                                                <a href="/warehouses/{{$warehouse->id}}/edit" class="btn btn-success text-white">Ubah</a>
                                            </div> {{-- /.card-footer --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-history" role="tabpanel" aria-labelledby="custom-tabs-three-history-tab">
                                
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-acounting" role="tabpanel" aria-labelledby="custom-tabs-three-acounting-tab">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('css')
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.css">
<link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
@endsection


@section('js')
<script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.4.3/dist/js/tabulator.min.js"></script>
<script type="text/javascript" src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
<script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
<script>
    //Trigger setFilter function with correct parameters
    function updateFilter(){

        var filter = $("#filter-field").val() == "function" ? customFilter : $("#filter-field").val();

        if($("#filter-field").val() == "function" ){
            $("#filter-type").prop("disabled", true);
            $("#filter-value").prop("disabled", true);
        }else{
            $("#filter-type").prop("disabled", false);
            $("#filter-value").prop("disabled", false);
        }

        table.setFilter(filter, "like", $("#filter-value").val());
        console.log(filter + ' | ' + $("#filter-type").val() + ' | ' + $("#filter-value").val());
    }

    //Update filters on value change
    $("#filter-field, #filter-type").change(updateFilter);
    $("#filter-value").change(updateFilter);

    //Clear filters on "Clear Filters" button click
    $("#filter-clear").click(function(){
        $("#filter-field").val("");
        $("#filter-type").val("=");
        $("#filter-value").val("");

        table.clearFilter();
    });
    //define table
    var table = new Tabulator("#kelas", {
        layout:"fitColumns",
        pagination:"local",
        paginationSize:4,
        paginationSizeSelector:[5, 10, 20, 50, 100],
        // groupBy: 'kelas',
        columns: [
            {title: 'Kelas', field: 'kelas'},
            {title: 'Tanggal Masuk', field: 'tanggal_masuk'},
            {title: 'No. Resi', field: 'no_resi'},
            {title: 'Petani', field: 'petani'},
            {
                title: 'Jumlah Berat', 
                field: 'jumlah_berat',
                formatter: "money", 
                formatterParams: { 
                    decimal: "", 
                    thousand: ".", 
                    symbolAfter: " Ton", 
                    precision: false,
                },
                bottomCalc:"sum", 
                bottomCalcParams: {
                    precision: false
                },
                bottomCalcFormatter: "money",
                bottomCalcFormatterParams:  {
                    decimal: "", 
                    thousand: ".", 
                    symbolAfter: " Ton", 
                    precision: false
                },     
            },
            {title: 'Harga Modal', field: 'harga_modal'},
            {
                title: 'Jumlah Harga', 
                field: 'jumlah_harga', 
                formatter: "money", 
                formatterParams: { 
                    decimal: ",", 
                    thousand: ".", 
                    symbol: "Rp. ", 
                    precision: false,
                },
                bottomCalc:"sum", 
                bottomCalcParams: {
                    precision: false
                },
                bottomCalcFormatter: "money",
                bottomCalcFormatterParams:  {
                    decimal: ",",
                    thousand: ".",
                    symbol: "Rp. ",
                    precision: false
                },         
            },
        ]
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

        var map = L.map('MapLocation').setView(curLocation, 15);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation);

        map.addLayer(marker);

        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            map.invalidateSize()
        })
    });
</script>
@endsection

@section('css')
<link href="https://unpkg.com/tabulator-tables@4.4.3/dist/css/tabulator.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabulator/4.4.3/css/bootstrap/tabulator_bootstrap4.min.css" integrity="sha256-+AmauyGZPl0HNTBQ5AMZBxfzP+rzXJjraezMKpWwWSE=" crossorigin="anonymous" />
<style type="text/css">
</style>
@endsection