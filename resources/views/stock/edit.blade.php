@extends('adminlte::page')
@section('title', 'Gudang | Edit Data Barang')
@section('content_header')
<h1 class="m-0 text-dark">Edit Data Barang</h1>
@stop
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">{{$incomingGoods->farmer->name}}</h5>
			</div>
			<form method="post" action="/stocks/{{$incomingGoods->id}}">
				@method('put')
				@csrf
				<div class="card-body">
					<div class="form-group row">
						<label for="farmer_id" class="col-md-4">Kelas</label>
						<div class="col-md-8">
							{{$incomingGoods->commodityGrade->name}}
						</div>
					</div>
					<div class="form-group row">
						<label for="weight" class="col-md-4">Berat</label>
						<div class="input-group col-md-8">
							<input type="text" class="form-control" id="weight" name="weight" placeholder="Berat" value="{{$incomingGoods->weight}}">
							<div class="input-group-append">
								<span class="input-group-text">Kg</span>
							</div>
						</div>
					</div>
				</div> {{-- /.card-body --}}
				<div class="card-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
				</div> {{-- /.card-footer --}}
			</form>
		</div> {{-- /.card --}}
	</div> {{-- /.col-md-6 --}}
</div> {{-- /.row --}}
@stop