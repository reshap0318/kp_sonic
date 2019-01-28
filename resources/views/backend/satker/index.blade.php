@extends('layouts.frontend')

@section('title')
  Satuan Kerja
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Satuan Kerja</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['satuan-kerja.create']))
        <a href="{{route('satuan-kerja.create')}}" class="btn btn-success">New Satuan Kerja</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tblsatker">
  <thead>
    <tr class="headings">
      <th class="text-center">
        No
      </th>
      <th>Nama </th>
      <th class="no-link last"><span class="nobr">Action</span>
      </th>
      <th class="bulk-actions" colspan="7">
        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
      </th>
    </tr>
  </thead>
  <?php $no=0?>
  <tbody>
    @foreach($satkers as $satker)
      <tr>
          <td class=" text-center">{{ ++$no }}</td>
          <td class=" ">{{$satker->nama}}</td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['satuan-kerja.show']))
              <a href="{{route('satuan-kerja.show', $satker->nama)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['satuan-kerja.edit']))
              <a href="{{route('satuan-kerja.edit', $satker->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['satuan-kerja.destroy']))
              {!! Form::open(['method'=>'DELETE', 'route' => ['satuan-kerja.destroy', $satker->id], 'style' => 'display:inline']) !!}
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
        table = $('#tblsatker').DataTable({
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
        return confirm("yakin Akan Menghapus Satuan Kerja Ini?");
    });

</script>
@endsection
