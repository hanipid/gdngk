<a href="/commodities/{{$commodity->id}}/grades/create" class="btn btn-success text-white btn-sm"><i class="fa fa-plus"></i> Buat Grade Baru</a>
<hr>
<table class="table table-hover table-sm" id="datatables">
    <thead>
        <tr>
            <th>Kelas</th>
            <th>Harga</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @php $total = 0 @endphp
        @foreach ($commodityGrades as $grade)
            <tr>
                <td>{{ $grade->name }}</td>
                <td>@ribuan($grade->price)</td>
                <td class="text-right">
                    {{-- <a href="/commodities/grade/{{$grade->id}}" class="btn btn-sm btn-primary text-white"><i class="fa fa-edit text-white"></i> Detail</a> --}}
                    <a href="/commodities/{{$grade->commodity_id}}/grades/{{$grade->id}}/edit" class="btn btn-sm btn-info text-white"><i class="fa fa-edit text-white"></i> Ubah</a>
                    <form method="post" action="/commodities/{{$grade->commodity_id}}/grades/{{$grade->id}}" onsubmit="return confirm('Apakah Anda yakin akan menghapus data ini?')" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger text-white"><i class="fa fa-trash text-white"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            @php $total += $grade->price @endphp
        @endforeach

        <tfoot>
            <tr>
                <th></th>
                <th>@ribuan($total)</th>
                <th></th>
            </tr>
        </tfoot>
    </tbody>
</table>


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

{{-- @include('partials.thousandjs') --}}