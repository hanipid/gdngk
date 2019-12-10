@extends('adminlte::page')

@section('css')
<style type="text/css">
	h1, h2, p {
		font-family: serif;
		margin: 0;
		padding: 0;
	}
	#cetak {
		background: #FFF;
	}
	.border {
		border: 4px solid #333 !important;
		padding: 5px 20px;
		margin: 20px;
	}
	.ttd {
	}
</style>
@stop

@section('content')
<div id="cetak">
	<div class="text-center">
		<h1 class="my-0"><u>RESI GUDANG</u></h1>
		<p class="my-0">DOKUMEN BUKTI KEPEMILIKAN</p>
		<h2 class="mt-2">NOMOR: {{$warehouseReceipt->receipt_number}}</h2>
	</div>

	<div class="border">
		<p>JENIS RESI GUDANG: ATAS NAMA</p>
	</div>

	<div class="border">
		<p>DITERBITKAN UNTUK:</p>
		<table>
			<tr>
				<td>NOMOR</td>
				<td>:</td>
				<td>KOPERASI KUD XXXX</td>
			</tr>
			<tr>
				<td>ALAMAT</td>
				<td>:</td>
				<td>Jalan Raya Nganjuk Nganjuk Nganjuk Kabupaten Nganjuk Jawa Timur</td>
			</tr>
		</table>
	</div>

	<div class="border">
		<p>TELAH DITERIMA SEJUMLAH BARANG SEBAGAIMANA TERSEBUT DI BAWAH INI UNTUK DISIMPAN DALAM GUDANG BERDASARKAN SURAT PERJANJIAN PENGELOLAAN BARANG</p>
		<table>
			<tr>
				<td>NOMOR</td>
				<td>:</td>
				<td>00011/VXYZ/XX/2019</td>
			</tr>
			<tr>
				<td>TANGGAL</td>
				<td>:</td>
				<td>12 Desember 2019</td>
			</tr>
		</table>
	</div>

	<div class="border">
		<table>
			<tr>
				<td>NAMA BARANG</td>
				<td>:</td>
				<td>{{ $warehouseReceipt->warehouse->commodity->name }}</td>
			</tr>
			<tr>
				<td>KELAS</td>
				<td>:</td>
				<td>@foreach ($warehouseReceipt->storedGoods as $storedGoods) {{$storedGoods->commodityGrade->name}}, @endforeach</td>
			</tr>
		</table>
	</div>

	<div class="border">
		<p>BARANG DITERIMA DAN DISIMPAN SEJAK TANGGAL: {{ date('d M Y', strtotime($warehouseReceipt->date)) }} S/D </p>
		<p>DENGAN SERTIFIKAT UNTUK BARANG:</p>
		<table>
			<tr>
				<td>NOMOR</td>
				<td>:</td>
				<td>001/ERTYU/92/2019</td>
			</tr>
			<tr>
				<td>TANGGAL</td>
				<td>:</td>
				<td>{{date('d M Y')}}</td>
			</tr>
			<tr>
				<td>OLEH</td>
				<td>:</td>
				<td>{{auth()->user()->name}}</td>
			</tr>
		</table>
	</div>

	<div class="border">
		<p>NILAI BARANG = 77.000,00 KG (ATAU MT) * X Rp. 4.000,00 = Rp. 308.000.000,00</p>
		<p><small>*SESUAIREFERENSI ACUAN HARGA</small></p>
		<p>BIAYA PENYIMPANAN = Rp. 23.100.000,00</p>
	</div>

	<div class="border">
		<p>JUMLAH BARANG *): 1.100 COLLY</p>
		<table>
			<tr>
				<td>JUMLAH BARANG *)</td>
				<td>:</td>
				<td>1.100 COLLY</td>
			</tr>
			<tr>
				<td></td><td></td><td>77.000 KG</td>
			</tr>
		</table>
		<p><small>* DIISI SESUAI DENGAN TIPE PENYIMPANAN</small></p>
	</div>

	<div class="border">
		<table>
			<tr>
				<td>LOKASI GUDANG</td>
				<td>:</td>
				<td>STIMULUS FISKAL APBD I GUDANG 1</td>
			</tr>
			<tr>
				<td></td><td></td><td>UPG. JATIM CLURING - BANYUWANGI</td>
			</tr>
		</table>
	</div>

	<div class="border">
		<p>BARANG TERSEBUT TELAH</p>
		<table>
			<tr>
				<td>DIASURANSIKAN TERHADAP RESIKO</td>
				<td>:</td>
				<td>KEBAKARAN</td>
			</tr>
			<tr>
				<td>NOMOR POLIS / MASA BERLAKU</td>
				<td>:</td>
				<td>SA 2019.00012</td>			
			</tr>
			<tr>
				<td></td><td></td><td>SEJAK TANGGAL 10 Desember 2019 S/D 10 MARET 2020</td>
			</tr>
			<tr>
				<td>NAMA PERUSAHAAN ASURANSI</td>
				<td>:</td>
				<td>Asuransi Sinarmas Syariah</td>
			</tr>
		</table>
	</div>

	<div class="border">
		<p>RESI GUDANG INI BERLAKU SAMPAI DENGAN TANGGAL 10 Maret 2020</p>
	</div>

	<div class="row my-4 pb-4">
		<div class="col-6 text-center">
			<p>PEMILIK BARANG</p>
			<div class="ttd my-4 py-4"></div>
			<p>{{ $warehouseReceipt->farmer->name }}</p>
		</div>

		<div class="col-6 text-center">
			<p>Nganjuk, 10 Desember 2019</p>
			<p>PT. PERTANI (Persero)</p>
			<div class="ttd my-3 py-4"></div>
			<p>{{ $warehouseReceipt->adminEmployee->name }}</p>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-footer">
		<button onclick="printDiv('cetak')" class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
	</div>
</div>
@stop

@section('js')
<script>
	printDiv('cetak')
    function printDiv(divName){
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@stop