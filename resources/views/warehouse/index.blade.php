@extends('adminlte::page')

@section('title', 'Data Gudang')

@section('content_header')
    <h1 class="m-0 text-dark">
        <i class="fa fa-warehouse"></i> Data Gudang
        <a href="/warehouses/create" class="btn btn-success btn-sm text-white"><i class="fa fa-plus"></i> Tambah Baru</a>
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
                                <th>Komoditas</th>
                                <th>Pemilik</th>
                                <th>Perusahaan</th>
                                <th>Kategori</th>
                                <th>Kecamatan</th>
                                <th>Kapasitas</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($warehouses as $warehouse)
                            <tr>
                                <td>{{ $warehouse->commodity->name }}</td>
                                <td>{{ $warehouse->user->name }}</td>
                                <td>{{ $warehouse->user->company }}</td>
                                <td>{{ $warehouse->warehouseCategory->name }}</td>
                                <td>{{ ucwords(strtolower($warehouse->district->name)) }}</td>
                                <td>{{ $warehouse->capacity / 1000 }} Ton</td>
                                <td class="text-right">
                                    <a href="/warehouses/{{$warehouse->id}}" class="btn btn-sm btn-primary text-white"><i class="fa fa-eye text-white"></i> {{-- Detail --}}</a>
                                    <a href="/warehouses/{{$warehouse->id}}/edit" class="btn btn-sm btn-info text-white"><i class="fa fa-edit text-white"></i> {{-- Ubah --}}</a>
                                    <form method="post" action="/warehouses/{{$warehouse->id}}" class="d-inline" onsubmit="return confirm('Apakahanda yakin ingin menghapus data ini?')">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger text-white"><i class="fa fa-trash text-white"></i> {{-- Hapus --}}</button>
                                    </form>
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