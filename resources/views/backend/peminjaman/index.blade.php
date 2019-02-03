@extends('layouts.frontend')

@section('title')
  Serah Terima
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Serah Terima</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['serah-terima.create']))
        <a href="{{route('serah-terima.create')}}" class="btn btn-success">New Serah Terima</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tblpeminjaman">
  <thead>
    <tr class="headings">
      <th class="text-center">
        No
      </th>
      <th>Nama </th>
      <th>No Serial</th>
      <th>Jenis </th>
      <th>Merek</th>
      <th>Tanggal </th>
      <th class="no-link last"><span class="nobr">Action</span>
      </th>
      <th class="bulk-actions" colspan="7">
        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
      </th>
    </tr>
  </thead>
  <?php $no=0?>
  <tbody>
    @foreach($peminjamans as $peminjaman)
      <tr>
          <td class=" text-center">{{ ++$no }}</td>
          <td class=" ">{{$peminjaman->user->nama}}</td>
          <td class=" ">{{$peminjaman->barang->no_serial}}</td>
          <td class=" ">{{optional(optional($peminjaman->barang)->jenis)->nama}}</td>
          <td class=" ">{{optional(optional($peminjaman->barang)->merek)->nama}}</td>
          <td class=" ">{{$peminjaman->tanggal}}</td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['serah-terima.show']))
              <a href="{{route('serah-terima.show', $peminjaman->id)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['serah-terima.edit']))
              <a href="{{route('serah-terima.edit', $peminjaman->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['serah-terima.destroy']))
              <!-- {!! Form::open(['method'=>'DELETE', 'route' => ['serah-terima.destroy', $peminjaman->id], 'style' => 'display:inline']) !!}
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
        table = $('#tblpeminjaman').DataTable({
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
        return confirm("yakin Akan Menghapus Serah Terima Ini?");
    });

</script>
@endsection
