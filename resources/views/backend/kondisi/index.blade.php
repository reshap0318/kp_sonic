@extends('layouts.frontend')

@section('title')
  Kondisi
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Kondisi</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['kondisi.create']))
        <a href="{{route('kondisi.create')}}" class="btn btn-success">New Kondisi</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tblkondisi">
  <thead>
    <tr class="headings">
      <th class="text-center">
        No
      </th>
      <th>Nama </th>
      <th>Total</th>
      <th class="no-link last"><span class="nobr">Action</span>
      </th>
      <th class="bulk-actions" colspan="7">
        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
      </th>
    </tr>
  </thead>
  <?php $no=0?>
  <tbody>
    @foreach($kondisis as $kondisi)
      <tr>
          <td class=" text-center">{{ ++$no }}</td>
          <td class=" ">{{$kondisi->nama}}</td>
          <td class=" "></td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['kondisi.show']))
              <a href="{{route('kondisi.show', $kondisi->nama)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['kondisi.edit']))
              <a href="{{route('kondisi.edit', $kondisi->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['kondisi.destroy']))
              {!! Form::open(['method'=>'DELETE', 'route' => ['kondisi.destroy', $kondisi->id], 'style' => 'display:inline']) !!}
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
        table = $('#tblkondisi').DataTable({
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
        return confirm("yakin Akan Menghapus Kondisi Ini?");
    });

</script>
@endsection
