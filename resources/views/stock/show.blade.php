@extends('adminlte::page')

@section('title', 'Gudang | Data Stok Gudang')

@section('content_header')
    <h1 class="m-0 text-dark">Data Stok Gudang</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
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
                                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Profile</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-three-tabContent">
                                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                    <table class="table table-hover table-sm" id="datatables">
                                        <thead>
                                            <tr>
                                                <th>Petani</th>
                                                <th>Kelas</th>
                                                <th>Berat</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($incomingGoods as $goods)
                                            <tr>
                                                <td>{{ $goods->farmer->name }}</td>
                                                <td>{{ $goods->commodityGrade->name }}</td>
                                                <td>@ribuan($goods->weight) Kg</td>
                                                <td class="text-right">
                                                    {{-- <a href="/stocks/{{$goods->id}}" class="btn btn-sm btn-primary text-white"><i class="fa fa-edit text-white"></i> Detail</a> --}}
                                                    <a href="/stocks/{{$goods->id}}/edit" class="btn btn-sm btn-info text-white"><i class="fa fa-edit text-white"></i> Ubah</a>
                                                    <form method="post" action="/stocks/deletegrade/{{$goods->id}}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin akan menghapus data ini?')">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger text-white"><i class="fa fa-trash text-white"></i> Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> {{-- /.tab-pane --}}
                                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <label for="user_id" class="col-md-4">Nama Petani</label>
                                                            <div class="col-md-8">
                                                                {{$farmer->name}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label for="commodity_id" class="col-md-4">Alamat</label>
                                                            <div class="col-md-8">
                                                                {{$farmer->address}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label for="capacity" class="col-md-4">Telepon</label>
                                                            <div class="col-8">
                                                                {{$farmer->phone}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label for="address" class="col-md-4">Bank</label>
                                                            <div class="col-8">
                                                                {{$farmer->bank}}
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <label for="kecamatan" class="col-md-4">No. Rekening</label>
                                                            <div class="col-8">
                                                                {{$farmer->bank_account}}
                                                            </div>
                                                        </div>
                                                    </div> {{-- /.card-body --}}
                                            </div> {{-- /.card --}}
                                        </div> {{-- /.col-md-6 --}}
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="text-center mb-3">
                                                            <img src="{{url('/storage/'.$farmer->avatar)}}" class="img-fluid">
                                                        </div>
                                                    </div> {{-- /.form-group --}}
                                                </div> {{-- /.card-body --}}
                                            </div> {{-- /.card --}}
                                        </div> {{-- /.col-md-6 --}}
                                    </div> {{-- /.row --}}
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three-history" role="tabpanel" aria-labelledby="custom-tabs-three-history-tab">
                                    <table class="table table-hover table-sm" id="datatables2">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Petani</th>
                                                <th>Komoditas</th>
                                                <th>Kelas</th>
                                                <th>Berat</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($goodsHistories as $goodsHistory)
                                            <tr>
                                                <td class="@if($goodsHistory->status == 'masuk') text-success @else text-danger @endif ">{{ $goodsHistory->status }}</td>
                                                <td>{{ date('d M Y', strtotime($goodsHistory->created_at)) }}</td>
                                                <td>{{ $goodsHistory->farmer->name }}</td>
                                                <td>{{ $goodsHistory->commodityGrade->commodity->name }}</td>
                                                <td>{{ $goodsHistory->commodityGrade->name }}</td>
                                                <td>@ribuan($goodsHistory->weight) Kg</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div> {{-- /.card --}}
        </div> {{-- /.col-md-12 --}}
    </div> {{-- /.row --}}
@stop

@section('css')
<link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@stop

@section('js')
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $('#datatables, #datatables2').DataTable({
        "order": [[ 1, "asc" ]]
    });
</script>
@stop