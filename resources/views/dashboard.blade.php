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
            <h2> <strong>Total : </strong> 20 </h2>
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
            <h2> <strong>Total : </strong> 20 </h2>
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
            <h2> <strong>Total : </strong> 20 </h2>
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
            <h2> <strong>Total : </strong> 20 </h2>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{route('barang.index',['kondisi=3'])}}" class="btn btn-primary">Lihat</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
