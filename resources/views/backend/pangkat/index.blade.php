@extends('layouts.frontend')

@section('title')
  Pangkat
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Pangkat</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['pangkat.create']))
        <a href="{{route('pangkat.create')}}" class="btn btn-success">New Pangkat</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tblPangkat">
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
    @foreach($pangkats as $pangkat)
      <tr>
          <td class=" text-center">{{ ++$no }}</td>
          <td class=" ">{{$pangkat->nama}}</td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['pangkat.show']))
              <a href="{{route('pangkat.show', $pangkat->nama)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['pangkat.edit']))
              <a href="{{route('pangkat.edit', $pangkat->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['pangkat.destroy']))
              {!! Form::open(['method'=>'DELETE', 'route' => ['pangkat.destroy', $pangkat->id], 'style' => 'display:inline']) !!}
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
        table = $('#tblPangkat').DataTable({
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
        return confirm("yakin Akan Menghapus Pangkat Ini?");
    });

</script>
@endsection
