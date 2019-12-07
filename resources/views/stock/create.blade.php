@extends('adminlte::page')
@section('title', 'Gudang | Tambah Data Barang')
@section('content_header')
<h1 class="m-0 text-dark">Tambah Data Barang</h1>
@stop
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<form method="post" action="/stocks">
				@csrf
				<div class="card-body">
					<div class="form-group row">
						<label for="farmer_id" class="col-md-4 col-form-label">Petani</label>
						<div class="col-md-8">
							<select class="form-control" name="farmer_id" id="farmer_id">
								@foreach ($farmers as $farmer)
									<option value="{{$farmer->id}}">{{$farmer->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					@foreach ($commodityGrades as $commodityGrade)
					<div class="form-group row">
						<label for="commodityGrade{{$loop->index}}" class="col-md-4 col-form-label">{{$commodityGrade->name}}</label>
						<div class="input-group col-md-8">
							<input type="hidden" class="form-control" id="commodityGradeId{{$loop->index}}" name="commodityGradeId[]" value="{{$commodityGrade->id}}">
							<input type="text" class="form-control" id="commodityGrade{{$loop->index}}" name="weight[]" placeholder="Berat">
							<div class="input-group-append">
								<span class="input-group-text">Kg</span>
							</div>
						</div>
					</div>
					@endforeach
				</div> {{-- /.card-body --}}
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div> {{-- /.card-footer --}}
			</form>
		</div> {{-- /.card --}}
	</div> {{-- /.col-md-6 --}}
</div> {{-- /.row --}}
@stop

@section('plugins.Select2', true)
@section('js')
<script>
$(document).ready(function () {
    $('#farmer_id').select2();
});
</script>
@stop