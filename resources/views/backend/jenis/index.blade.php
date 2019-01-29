@extends('layouts.frontend')

@section('title')
  Jenis Barang
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Jenis Barang</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['jenis-barang.create']))
        <a href="{{route('jenis-barang.create')}}" class="btn btn-success">New Jenis Barang</a>
        <a href="{{route('barang.create')}}" class="btn btn-success">New Barang</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tbljenis">
  <thead>
    <tr class="headings">
      <th rowspan="2" class="text-center">
        No
      </th>
      <th rowspan="2" class="text-center">Nama </th>
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
    @foreach($jeniss as $jenis)
      <tr>
          <td class=" text-center">{{ ++$no }}</td>
          <td class="">{{$jenis->nama}}</td>
          <td class=" text-center">{{$jenis->baik}} Buah</td>
          <td class=" text-center">{{$jenis->rusak}} Buah</td>
          <td class=" text-center">{{$jenis->rusakberat}} Buah</td>
          <td class=" text-center">{{$jenis->dihapuskan}} Buah</td>
          <td class=" text-center">{{$jenis->baik+$jenis->rusak+$jenis->rusakberat+$jenis->dihapuskan}} Buah</td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['jenis-barang.show']))
              <a href="{{route('jenis-barang.show', $jenis->nama)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['jenis-barang.edit']))
              <a href="{{route('jenis-barang.edit', $jenis->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['jenis-barang.destroy']))
              {!! Form::open(['method'=>'DELETE', 'route' => ['jenis-barang.destroy', $jenis->id], 'style' => 'display:inline']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm']) !!}
              {!! Form::close() !!}
            @endif
          </td>
        </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        table = $('#tbljenis').DataTable({
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

  $("input#delete-confirm").on("click", function(){
        return confirm("yakin Akan Menghapus Jenis Barang Ini?");
    });

</script>
@endsection
