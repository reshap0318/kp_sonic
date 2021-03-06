@extends('layouts.frontend')

@section('title')
  Barang
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Barang</h2>
    <ul class="nav navbar-right panel_toolbox">
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tblbarang">
  <thead>
    <tr class="headings">
      <th class="text-center">
        No
      </th>
      <th>Nomor Serial</th>
      <th>Satker</th>
      <th>Jenis</th>
      <th>Merek</th>
      <th>Kondisi</th>
      <th class="no-link last"><span class="nobr">Action</span>
      </th>
      <th class="bulk-actions" colspan="7">
        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
      </th>
    </tr>
  </thead>
  <?php $no=0?>
  <tbody>
    @foreach($barangs as $barang)
      <tr>
          <td class=" text-center">{{ ++$no }}</td>
          <td class=" ">{{$barang->no_serial}}</td>
          <td class=" ">{{optional($barang->satker)->nama}}</td>
          <td class=" ">{{optional($barang->jenis)->nama}}</td>
          <td class=" ">{{optional($barang->merek)->nama}}</td>
          <td>@if($barang->kondisi==1)
            Baik
            @elseif($barang->kondisi==2)
            Rusak Ringan
            @elseif($barang->kondisi==3)
            Rusak Berat
            @elseif($barang->kondisi==4)
            Dihapuskan
            @else
            Kesalahan
          @endif</td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['barang.show']))
              <a href="{{route('barang.show', $barang->id)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['barang.edit']))
              <a href="{{route('barang.edit', $barang->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['barang.destroy']))
              {!! Form::open(['method'=>'DELETE', 'route' => ['barang.destroy', $barang->id], 'style' => 'display:inline']) !!}
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
<div class="col-md-12 text-center">
  <a href="{{route('jenis-barang.index')}}" class="btn btn-success">Kembali</a>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        table = $('#tblbarang').DataTable({
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
        return confirm("yakin Akan Menghapus Barang Ini?");
    });

</script>
@endsection
