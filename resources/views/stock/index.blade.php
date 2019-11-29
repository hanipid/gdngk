@extends('adminlte::page')

@section('title', 'Data Stok Barang')

{{-- @can('add', App\IncomingGoods::first()) --}}

    @section('content_header')
        <h1 class="m-0 text-dark">
            <i class="fa fa-seedling"></i> Data Stok Barang
            <a href="/stocks/create" class="btn btn-success btn-sm text-white"><i class="fa fa-plus"></i> Tambah Baru</a>
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
                                    <th>NIK</th>
                                    <th>Nama Petani</th>
                                    <th>Alamat</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($incomingGoods as $goods)
                                <tr>
                                    <td>{{ $goods->farmer->nik }}</td>
                                    <td>{{ $goods->farmer->name }}</td>
                                    <td>{{ $goods->farmer->address }}</td>
                                    <td class="text-right">
                                        <a href="/stocks/{{$goods->warehouse_id}}/{{$goods->farmer_id}}" class="btn btn-sm btn-primary text-white"><i class="fa fa-edit text-white"></i> Detail</a>
                                        {{-- <a href="/stocks/{{$goods->id}}/edit" class="btn btn-sm btn-info text-white"><i class="fa fa-edit text-white"></i> Ubah</a> --}}
                                        <form method="post" action="/stocks/{{$goods->id}}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin akan menghapus data ini?')">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger text-white"><i class="fa fa-trash text-white"></i> Hapus</button>
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
    
{{-- @endcan --}}