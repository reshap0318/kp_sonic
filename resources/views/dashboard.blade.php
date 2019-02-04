@extends('layouts.frontend')

@section('title')
  Dashboard
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Dashboard</h2>
    <div class="clearfix"></div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-3">
    <div class="x_panel">
      <div class="x_title">
        <h2>Barang</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6">
            <h2> <strong>Total : </strong> {{$g1->baik+$g1->rusak+$g1->rusakberat}} </h2>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{route('barang.index')}}" class="btn btn-primary">Lihat</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="x_panel">
      <div class="x_title">
        <h2>Barang Baik</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6">
            <h2> <strong>Total : </strong> {{$g1->baik}} </h2>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{route('barang.index',['kondisi=1'])}}" class="btn btn-primary">Lihat</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="x_panel">
      <div class="x_title">
        <h2>Barang Rusak Ringan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6">
            <h2> <strong>Total : </strong> {{$g1->rusak}} </h2>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{route('barang.index',['kondisi=2'])}}" class="btn btn-primary">Lihat</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="x_panel">
      <div class="x_title">
        <h2>Barang Rusak Berat</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6">
            <h2> <strong>Total : </strong> {{$g1->rusakberat}} </h2>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{route('barang.index',['kondisi=3'])}}" class="btn btn-primary">Lihat</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-6">
    <div class="x_panel">
      <div class="x_title">
        <h2>Total Barang</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div id="app">
            {!! $chart_barang_jenis->container() !!}
          </div>

          <script src="https://unpkg.com/vue"></script>
          <script>
              var app = new Vue({
                  el: '#app',
              });
          </script>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
          {!! $chart_barang_jenis->script() !!}
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="x_panel">
      <div class="x_title">
        <h2>Total Peminjaman yang Belum Dikembalikan</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div id="app">
            {!! $chart_pinjam_jenis->container() !!}
          </div>

          <script src="https://unpkg.com/vue"></script>
          <script>
              var app = new Vue({
                  el: '#app',
              });
          </script>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
          {!! $chart_pinjam_jenis->script() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
