@extends('layouts.frontend')

@section('title')
	Detail Peminjaman {{optional($peminjaman->barang)->no_serial}} oleh {{optional($peminjaman->user)->nama}}
@stop


@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Detail Peminjaman {{optional($peminjaman->barang)->no_serial}} oleh {{optional($peminjaman->user)->nama}}</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
				<div class="row">
					<div class="col-md-offset-2 col-md-2">
						<b>Tanggal Peminjaman</b>
					</div>
					<div class="col-md-8">
						: {{$peminjaman->tanggal}}
					</div>
          <br><br>
					<div class="col-md-offset-2 col-md-2">
						<b>No Serial Barang</b>
					</div>
					<div class="col-md-8">
						: {{optional($peminjaman->barang)->no_serial}}
					</div>
          <br><br>
					<div class="col-md-offset-2 col-md-2">
						<b>Pemberi Barang</b>
					</div>
					<div class="col-md-8">
						: {{$peminjaman->pemberi->nama}}
					</div>
          <br><br>
					<div class="col-md-offset-2 col-md-2">
						<b>Jenis</b>
					</div>
					<div class="col-md-8">
						: {{optional(optional($peminjaman->barang)->jenis)->nama}}
					</div>
          <br><br>
					<div class="col-md-offset-2 col-md-2">
						<b>Penerima Barang</b>
					</div>
					<div class="col-md-8">
						: {{$peminjaman->user->nama}}
					</div>
          <br><br>
					<div class="col-md-offset-2 col-md-2">
						<b>Type</b>
					</div>
					<div class="col-md-8">
						:  {{optional(optional($peminjaman->barang)->jenis)->nama}}
					</div>
          <br><br>
          <div class="col-md-offset-2 col-md-2">
						<b>Kondisi</b>
					</div>
					<div class="col-md-8">
						: @if($peminjaman->kondisi==1)
	            	Baik
	            @elseif($peminjaman->kondisi==2)
	            	Rusak Ringan
	            @elseif($peminjaman->kondisi==3)
	            	Rusak Berat
	            @elseif($peminjaman->kondisi==4)
	            	Dihapuskan
	            @else
	            	Kesalahan
	          	@endif
					</div>
          <br><br>
					<div class="col-md-offset-2 col-md-2">
						<b>Keterangan</b>
					</div>
					<div class="col-md-8">
						: {{$peminjaman->keterangan}}
					</div>
          <br><br>
				</div>
      </div>
    </div>
  </div>
</div>
@stop
