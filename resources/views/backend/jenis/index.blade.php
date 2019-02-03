@extends('layouts.frontend')

@section('title')
  Jenis Barang
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Jenis Barang</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAnyAccess(['jenis-barang.create','merek.create','barang.create']))
        <a href="{{route('jenis-barang.create')}}" class="btn btn-success">New Jenis Barang</a>
        <a href="{{route('merek.create')}}" class="btn btn-success">New Merek</a>
        <a href="{{route('barang.create')}}" class="btn btn-success">New Barang</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tblbrg">
      <thead>
        <tr class="headings">
          <th rowspan="2" class="text-center">
            No
          </th>
          <th rowspan="2" class="text-center">Nama </th>
          <th rowspan="2" class="text-center">Satker</th>
          <th colspan="4" class="text-center">Kodisi</th>
          <th rowspan="2" class="text-center">Total</th>
          <th rowspan="2" class="no-link last text-center"><span class="nobr">Action</span></th>
        </tr>
        <tr>
          <th class="text-center">Baik</th>
          <th class="text-center">Rusak Ringan</th>
          <th class="text-center">Rusak Berat</th>
          <th class="text-center">Dihapuskan</th>
        </tr>
      </thead>
      <?php $no=0?>
      <tbody>
        @foreach($barangs as $barang)
          <tr>
              <td class=" text-center">{{ ++$no }}</td>
              <td class="">{{$barang->nama}}</td>
              <td class="">{{$barang->satker}}</td>
              <td class=" text-center">{{$barang->baik}}</td>
              <td class=" text-center">{{$barang->rusak}}</td>
              <td class=" text-center">{{$barang->rusakberat}}</td>
              <td class=" text-center">{{$barang->dihapuskan}}</td>
              <td class=" text-center">{{$barang->baik+$barang->rusak+$barang->rusakberat+$barang->dihapuskan}}</td>
              <td class=" last text-center">
                @if (Sentinel::getUser()->hasAccess(['jenis-barang.show']))
                  <a href="{{route('jenis-barang.show', $barang->nama)}}?id={{$barang->satker_id}}" class="btn btn-success btn-xs">View</a>
                @endif
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<br><br>

<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Jenis Barang</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <table class="table table-bordered table-striped table-hover" id="tbljenis">
        <thead>
          <tr class="headings">
            <th style="width:20px" class="text-center">No</th>
            <th>Jenis</th>
            <th class="text-center">Total</th>
            <th>aksi</th>
          </tr>
        </thead>
        <?php $no=0?>
        <tbody>
          @foreach($jeniss as $jenis)
            <tr>
                <td style="width:20px" class=" text-center">{{ ++$no }}</td>
                <td class="">{{$jenis->nama}}</td>
                <td class="text-center">{{$jenis->total}}</td>
                <td class=" last">
                  @if (Sentinel::getUser()->hasAccess(['jenis-barang.show']))
                    <a href="{{route('jenis-barang.show', $jenis->nama)}}" class="btn btn-success btn-xs">View</a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['jenis-barang.edit']))
                    <a href="{{route('jenis-barang.edit', $jenis->id)}}" class="btn btn-success btn-xs">edit</a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['jenis-barang.destroy']))
                    {!! Form::open(['method'=>'DELETE', 'route' => ['jenis-barang.destroy', $jenis->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm-jenis']) !!}
                    {!! Form::close() !!}
                  @endif
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Merek Barang</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <table class="table table-bordered table-striped table-hover" id="tblmerek">
        <thead>
          <tr class="headings">
            <th class="text-center">No</th>
            <th>Merek</th>
            <th class="text-center">Total</th>
            <th>aksi</th>
          </tr>
        </thead>
        <?php $no=0?>
        <tbody>
          @foreach($mereks as $merek)
            <tr>
                <td style="width:20px" class=" text-center">{{ ++$no }}</td>
                <td class="">{{$merek->nama}}</td>
                <td class="text-center">{{$merek->total}}</td>
                <td class=" last">
                  @if (Sentinel::getUser()->hasAccess(['merek.show']))
                    <a href="{{route('merek.show', $merek->nama)}}" class="btn btn-success btn-xs">View</a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['merek.edit']))
                    <a href="{{route('merek.edit', $merek->id)}}" class="btn btn-success btn-xs">edit</a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['merek.destroy']))
                    {!! Form::open(['method'=>'DELETE', 'route' => ['merek.destroy', $merek->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm-merek']) !!}
                    {!! Form::close() !!}
                  @endif
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        table = $('#tblbrg').DataTable({
            'columnDefs': [{
               'targets': 0,
               'searchable':false,
               'orderable':false,
            }],
            dom: 'Bfrtip',
            buttons: [
              {
                  extend: 'copy',
                  exportOptions: {
                      columns: [0, 1]
                  }
              },
              {
                  extend: 'print',
                  exportOptions: {
                      columns: [0, 1]
                  }
              },
              {
                  extend: 'csv',
                  exportOptions: {
                      columns: [0, 1]
                  }
              },
              {
                  extend: 'excel',
                  exportOptions: {
                      columns: [0, 1]
                  }
              },
              {
                  extend: 'pdf',
                  exportOptions: {
                      columns: [0, 1]
                  }
              }
            ]

          });
    });

    $(document).ready(function(){
        table = $('#tbljenis').DataTable({
          'columnDefs': [{
             'targets': 0,
             'searchable':false,
             'orderable':false,
          }],
        });
      });


      $(document).ready(function(){
        table = $('#tblmerek').DataTable({
          'columnDefs': [{
             'targets': 0,
             'searchable':false,
             'orderable':false,
          }],
        });
      });

    $("input#delete-confirm-jenis").on("click", function(){
      return confirm("yakin Akan Menghapus Jenis Barang Ini?");
    });

    $("input#delete-confirm-merek").on("click", function(){
      return confirm("yakin Akan Menghapus Merek Barang Ini?");
    });

</script>
@endsection
