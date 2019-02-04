@extends('layouts.frontend')

@section('title')
  Pengembalian Barang
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Pengembalian Barang</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['pengembalian.create']))
        <a href="{{route('pengembalian.create')}}" class="btn btn-success">Pengembalian Barang</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tblpengembalian">
  <thead>
    <tr class="headings">
      <th class="text-center">
        No
      </th>
      <th>Pengembalian</th>
      <th>No Serial</th>
      <th>Jenis </th>
      <th>Merek</th>
      <th>Kondisi</th>
      <th>Peminjaman</th>
      <th class="no-link last"><span class="nobr">Action</span>
      </th>
      <th class="bulk-actions" colspan="7">
        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
      </th>
    </tr>
  </thead>
  <?php $no=0?>
  <tbody>
    @foreach($pengembalians as $pengembalian)
      <tr>
          <td class=" text-center">{{ ++$no }}</td>
          <td class=" ">{{$pengembalian->tanggal}}</td>
          <td class=" ">{{optional(optional($pengembalian->peminjaman)->barang)->no_serial}}</td>
          <td class=" ">{{optional(optional(optional($pengembalian->peminjaman)->barang)->jenis)->nama}}</td>
          <td class=" ">{{optional(optional(optional($pengembalian->peminjaman)->barang)->merek)->nama}}</td>
          <td class=" ">@if($pengembalian->kondisi==1)
            Baik
            @elseif($pengembalian->kondisi==2)
            Rusak Ringan
            @elseif($pengembalian->kondisi==3)
            Rusak Berat
            @elseif($pengembalian->kondisi==4)
            Dihapuskan
            @else
            Kesalahan
          @endif</td>
          <td class=" ">{{optional($pengembalian->peminjaman)->tanggal}}</td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['pengembalian.show']))
              <a href="{{route('pengembalian.show', $pengembalian->id)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['pengembalian.edit']))
              <a href="{{route('pengembalian.edit', $pengembalian->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['pengembalian.destroy']))
              <!-- {!! Form::open(['method'=>'DELETE', 'route' => ['pengembalian.destroy', $pengembalian->id], 'style' => 'display:inline']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm']) !!}
              {!! Form::close() !!} -->
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
        table = $('#tblpengembalian').DataTable({
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
        return confirm("yakin Akan Menghapus Pengembalian Barang Ini?");
    });

</script>
@endsection
