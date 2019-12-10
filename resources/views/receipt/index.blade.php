@extends('adminlte::page')

@section('title', 'Data Gudang')

@section('content_header')
    <h1 class="m-0 text-dark">
        <i class="fa fa-warehouse"></i> Barang Baru
    </h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-hover table-sm" id="datatables">
                        <thead>
                            <tr>
                                <th>Gudang</th>
                                <th>Komoditas</th>
                                <th>Petani</th>
                                <th>Kapasitas</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($incomingGoods as $goods)
                            <tr>
                                <td>{{ $goods->warehouse->user->name }}</td>
                                <td>{{ $goods->commodityGrade->commodity->name }}</td>
                                <td>{{ $goods->farmer->name }}</td>
                                <td>@ribuan($goods->sum_weight) Kg</td>
                                <td class="text-right">
                                    <a href="/receipts/{{$goods->farmer_id}}/create" class="btn btn-sm btn-primary text-white"><i class="fa fa-edit text-white"></i> Buat Resi</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

{{-- @section('plugins.Datatables', true) --}}

@section('css')
<link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@stop

@section('js')
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $('#datatables').DataTable();
</script>
@stop