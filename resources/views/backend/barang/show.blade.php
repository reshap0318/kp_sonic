@extends('layouts.frontend')

@section('title')
	Detail Barang
@stop


@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Detail Barang</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
				<div class="row">
					<div class="col-md-offset-2 col-md-2">
						<b>Nomor Serial</b>
					</div>
					<div class="col-md-8">
						: {{$barang->no_serial}}
					</div>
					<br>
					<br>
					<div class="col-md-offset-2 col-md-2">
						<b>Tahun Perolehan</b>
					</div>
					<div class="col-md-8">
						: {{$barang->th_perolehan}}
					</div>
					<br>
					<br>
					<div class="col-md-offset-2 col-md-2">
						<b>Satuan Kerja</b>
					</div>
					<div class="col-md-8">
						:	{{optional($barang->satker)->nama}}
					</div>
					<br>
					<br>
					<div class="col-md-offset-2 col-md-2">
						<b>Jenis</b>
					</div>
					<div class="col-md-8">
						: {{optional($barang->jenis)->nama}}
					</div>
					<br>
					<br>
					<div class="col-md-offset-2 col-md-2">
						<b>Merek</b>
					</div>
					<div class="col-md-8">
						: {{optional($barang->merek)->nama}}
					</div>
					<br>
					<br>
					<div class="col-md-offset-2 col-md-2">
						<b>Type</b>
					</div>
					<div class="col-md-8">
						: {{$barang->type}}
					</div>

					<br>
					<br>
					<div class="col-md-offset-2 col-md-2">
						<b>Kondisi</b>
					</div>
					<div class="col-md-8">
						: @if($barang->kondisi==1)
	            	Baik
	            @elseif($barang->kondisi==2)
	            	Rusak Ringan
	            @elseif($barang->kondisi==3)
	            	Rusak Berat
	            @elseif($barang->kondisi==4)
	            	Dihapuskan
	            @else
	            	Kesalahan
	          	@endif
					</div>

					<br>
					<br>
					<div class="col-md-offset-2 col-md-2">
						<b>Status</b>
					</div>
					<div class="col-md-8">
						: @if($barang->status == 1)
							Barang Sekarang Berada Didalam Satker
						@elseif($barang->status == 0)
							Barang Sedang Dipinjam
						@endif
					</div>

					<br>
					<br>
					<div class="col-md-offset-2 col-md-2">
						<b>Keterangan</b>
					</div>
					<div class="col-md-8">
						: {{$barang->keterangan}}
					</div>
				</div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
		    <h2>Riwayat Pemakaian Barang</h2>
		    <div class="clearfix"></div>
		  </div>
		  <div class="x_content">
		    <table class="table table-bordered table-striped table-hover" id="tblpeminjaman">
			  <thead>
			    <tr class="headings">
			      <th class="text-center">No</th>
			      <th>Nama</th>
			      <th>Peminjaman</th>
			      <th>Kondisi Peminjaman</th>
			      <th>Pengembalian</th>
			      <th>Kondisi Dikembalian</th>
			    </tr>
			  </thead>
			  <?php $no=0?>
			  <tbody>
			    @foreach($barang->peminjaman as $peminjaman)
			      <tr>
			          <td class=" text-center">{{ ++$no }}</td>
			          <td class=" ">{{$peminjaman->user->nama}}</td>
			          <td class=" ">{{$peminjaman->tanggal}}</td>
			          <td class=" ">@if($peminjaman->kondisi==1)
			            	Baik
			            @elseif($peminjaman->kondisi==2)
			            	Rusak Ringan
			            @elseif($peminjaman->kondisi==3)
			            	Rusak Berat
			            @elseif($peminjaman->kondisi==4)
			            	Dihapuskan
			            @else
			            	Kesalahan
			          	@endif</td>
			          <td class=" ">@if(optional($peminjaman->pengembalian)->tanggal)
									{{optional($peminjaman->pengembalian)->tanggal}}
								@else
									Barang Belum Dikembalikan
								@endif</td>
			          <td class=" ">@if(optional($peminjaman->pengembalian)->kondisi==1)
			            	Baik
			            @elseif(optional($peminjaman->pengembalian)->kondisi==2)
			            	Rusak Ringan
			            @elseif(optional($peminjaman->pengembalian)->kondisi==3)
			            	Rusak Berat
			            @elseif(optional($peminjaman->pengembalian)->kondisi==4)
			            	Dihapuskan
			            @else
			            	Barang Belum Dikembalikan
			          	@endif</td>
			        </tr>
			    @endforeach
			  </tbody>
		  </table>
		  </div>
		</div>
	</div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
      table = $('#tblpeminjaman').DataTable({
        'columnDefs': [{
           'targets': 0,
           'searchable':false,
           'orderable':false,
        }],
	    });
		});

</script>
@endsection
