@extends('layouts.frontend')
@section('title')
  List Polres
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Daftar Polres</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['polres.create']))
        <a href="{{route('polres.create')}}" class="btn btn-success">New Polres</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tblpolres">
      <thead>
        <tr class="headings">
          <th class="text-center">No</th>
          <th>Nama Polres</th>
          <th>Email Polres</th>
          <th>Alamat</th>
          <th class="no-link last"><span class="nobr">Action</span></th>
          <th class="bulk-actions" colspan="7">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
          </th>
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($polress as $polres)
              <td class=" text-center">{{ ++$no }}</td>
              <td class=" ">{{$polres->nama}}</td>
              <td class=" ">{{$polres->email}}</td>
              <td class=" ">{{$polres->alamat}}</td>
              <td class=" last">
                @if (Sentinel::getUser()->hasAccess(['polres.edit']))
                  <a href="{{route('polres.edit', $polres->id)}}" class="btn btn-success btn-xs">edit</a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['polres.destroy']))
                  {!! Form::open(['method'=>'DELETE', 'route' => ['polres.destroy', $polres->id], 'style' => 'display:inline']) !!}
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
      table = $('#tblpolres').DataTable({
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
                      columns: [0, 1, 2, 3]
                  }
              },
              {
                  extend: 'print',
                  exportOptions: {
                      columns: [0, 1, 2, 3]
                  }
              },
              {
                  extend: 'csv',
                  exportOptions: {
                      columns: [0, 1, 2, 3]
                  }
              },
              {
                  extend: 'excel',
                  exportOptions: {
                      columns: [0, 1, 2, 3]
                  }
              },
              {
                  extend: 'pdf',
                  exportOptions: {
                      columns: [0, 1, 2, 3]
                  }
              }
            ]
        });
    });

  $("input#delete-confirm").on("click", function(){
      return confirm("Yakin Ingin Menghapus Polres Ini?");
  });

</script>
@stop
