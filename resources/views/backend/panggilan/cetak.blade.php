@extends('layouts.frontend')
@section('title')
  Laporan Panggilan
@stop

@section('content')
<div class="x_panel" id="cetak">
  <div class="x_title">
    <h2>Laporan Panggilan ({{$_GET['waktu']}}</h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tblpanggilan">
      <thead>
        <tr class="headings">
          <th class="text-center">No</th>
          <th>Tanggal</th>
          <th>Petugas</th>
          <th>Operator</th>
          <th>Polres</th>
          <th>PT (buah)</th>
          <th>PP(buah)</th>
          <th>PTT(buah)</th>
          <th>TP(buah)</th>
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($panggilans as $panggilan)
          <tr>
            <td class=" text-center">{{ ++$no }}</td>
            <td class=" ">{{$panggilan->tanggal}}</td>
            <td class=" ">{{optional($panggilan->user)->nama}}</td>
            <td class=" ">
              @foreach($panggilan->piket as $piket)
                {{$piket}},
              @endforeach
            </td>
            <td class=" ">{{optional($panggilan->polres)->nama}}</td>
            <td class=" text-center">{{$panggilan->panggilan_terselesaikan}}</td>
            <td class=" text-center">{{$panggilan->panggilan_prank}}</td>
            <td class=" text-center">{{$panggilan->panggilan_tidak_terjawab}}</td>
            <td class=" text-center">{{$panggilan->panggilan_terselesaikan + $panggilan->panggilan_tidak_terjawab + $panggilan->panggilan_prank}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="text-center">
    <div class="col-md-3">
      {!! Form::label('nama','*PT :') !!} Panggilan Terselesaikan
    </div>
    <div class="col-md-3">
     {!! Form::label('nama','*PP :') !!} Panggilan Prank
    </div>
    <div class="col-md-3">
      {!! Form::label('nama','*TP :') !!} Total Panggilan
    </div>
    <div class="col-md-3">
      {!! Form::label('nama','*PTT :') !!} Panggilan Tidak Terjawab <br>
    </div>
  </div>
</div>
<div class="text-center">
  <a href="{{route('panggilan.index')}}" class="btn btn-primary">Kembali</a>
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
