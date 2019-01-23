@extends('layouts.frontend')
@section('title')
  Laporan Polres
@stop

@section('content')
<div class="x_panel" id="cetak">
  <div class="x_title">
    <h2>Laporan Polres ({{$_GET['waktu']}})</h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tblpolres">
      <thead>
        <tr class="headings">
          <th class="text-center">No</th>
          <th class="text-center">Polres</th>
          <th class="text-center">Panggilan Terselesaikan</th>
          <th class="text-center">Panggilan Prank</th>
          <th class="text-center">Panggilan Tidak Terangkat</th>
          <th class="text-center">Total Panggilan</th>
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($panggilans as $panggilan)
          <tr>
            <td class=" text-center">{{ ++$no }}</td>
            <td class=" ">{{$panggilan->nama}}</td>
            <td class=" text-center">@if($panggilan->panggilan_terselesaikan)
              {{$panggilan->panggilan_terselesaikan}}
              @else
              0
            @endif</td>
            <td class=" text-center">@if($panggilan->panggilan_prank)
              {{$panggilan->panggilan_prank}}
              @else
              0
            @endif</td>
            <td class=" text-center">@if($panggilan->panggilan_tidak_terjawab)
                {{$panggilan->panggilan_tidak_terjawab}}
              @else
              0
            @endif</td>
            <td class=" text-center">{{$panggilan->panggilan_terselesaikan + $panggilan->panggilan_tidak_terjawab + $panggilan->panggilan_prank}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="text-center">
  <a href="{{route('polres.index')}}" class="btn btn-primary">Kembali</a>
  <a href="#" onclick="cetak()" class="btn btn-primary">Cetak</a>
</div>

<script type="text/javascript">
  var waktu = 1;
  var a = 'a';
  setInterval(function() {
    waktu--;
    if(waktu < 0) {
      if(a=='a'){
        a = 'b';
        cetak();
      }
    }
  }, 1000);


  function cetak() {
    var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById('cetak').innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
  }
</script>
@endsection
