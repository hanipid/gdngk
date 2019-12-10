@extends('adminlte::page')
@section('title', 'Pembuatan Nomor Resi')
@section('content_header')
<h1 class="m-0 text-dark">Pembuatan Nomor Resi</h1>
@stop
@section('content')
<form method="post" action="/receipts" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-6">
        <div class="card">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="receipt_number" class="col-md-4 col-form-label">Nomor Resi</label>
                        <div class="input-group col-8">
                            <input type="text" class="form-control" name="receipt_number" id="receipt_number" placeholder="Nomor Resi" value="{{ date_format(now(), 'dmyHisv')}}">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-4">Pemilik Gudang</label>
                        <div class="input-group col-md-8">
                            {{ $incomingGoods[0]->warehouse->user->name }} &nbsp;
                            <strong>{{ $incomingGoods[0]->warehouse->user->company }}</strong>
                            <input type="hidden" name="warehouse_id" value="{{ $incomingGoods[0]->warehouse_id }}">
                            <input type="hidden" name="warehouse_employee_id" value="{{ $incomingGoods[0]->employee_id }}">
                            <input type="hidden" name="admin_employee_id" value="{{ auth()->user()->id }}">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-4">Alamat Gudang</label>
                        <div class="input-group col-md-8">
                            {{ $incomingGoods[0]->warehouse->address }}
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-4">Sewa Gudang</label>
                        <div class="input-group col-md-8">
                            @php $sumWeight = 0 @endphp
                            @foreach ($incomingGoods as $goods)
                                @php $sumWeight += $goods->weight @endphp
                            @endforeach
                            @php $sumRentalPrice = $incomingGoods[0]->commodityGrade->commodity->rental_price * $sumWeight @endphp
                            @rupiah( $sumRentalPrice )
                            <input type="hidden" name="warehouse_rental" value="{{ (double)$sumRentalPrice }}">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-4">Petani</label>
                        <div class="input-group col-md-8">
                            {{ $incomingGoods[0]->farmer->name }}
                            <input type="hidden" name="farmer_id" value="{{ $incomingGoods[0]->farmer_id }}">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-4">Alamat Petani</label>
                        <div class="input-group col-md-8">
                            {{ $incomingGoods[0]->farmer->address }}
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-md-4">Barang</label>
                        <div class="col-md-8">
                            <p>{{ $incomingGoods[0]->commodityGrade->commodity->name }}</p>
                            @foreach ($incomingGoods as $goods)
                                <p>{{ $goods->commodityGrade->name }} - @ribuan($goods->weight) Kg</p>
                                <input type="hidden" name="commodity_grade_id[]" value="{{ $goods->commodityGrade->id }}">
                                <input type="hidden" name="goods_weight[]" value="{{ $goods->weight }}">
                                <input type="hidden" name="goods_price[]" value="{{ $goods->commodityGrade->price }}">
                            @endforeach
                        </div>
                    </div>
                </div> {{-- /.card-body --}}
        </div> {{-- /.card --}}
    </div> {{-- /.col-md-6 --}}
</div> {{-- /.row --}}

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-footer text-right">
                <input type="hidden" name="date" value="{{ date('Y-m-d') }}">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div> {{-- /.card-footer --}}
        </div>
    </div>
</div>
</form>
@stop

@include('partials.thousandjs')
