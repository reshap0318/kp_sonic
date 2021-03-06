@extends('layouts.frontend')

@section('title')
  Jabatan
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Jabatan</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['jabatan.create']))
        <a href="{{route('jabatan.create')}}" class="btn btn-success">New Jabatan</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tblJabatan">
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
    @foreach($jabatans as $jabatan)
      <tr>
          <td class=" text-center">{{ ++$no }}</td>
          <td class=" ">{{$jabatan->nama}}</td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['jabatan.show']))
              <a href="{{route('jabatan.show', $jabatan->nama)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['jabatan.edit']))
              <a href="{{route('jabatan.edit', $jabatan->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['jabatan.destroy']))
              {!! Form::open(['method'=>'DELETE', 'route' => ['jabatan.destroy', $jabatan->id], 'style' => 'display:inline']) !!}
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
        table = $('#tblJabatan').DataTable({
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
        return confirm("yakin Akan Menghapus Jabatan Ini?");
    });

</script>
@endsection
