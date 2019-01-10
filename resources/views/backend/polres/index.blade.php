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
          <th>Telepon</th>
          <th>Alamat</th>
          @if(Sentinel::getUser()->hasAnyAccess(['polres.show','polres.edit','polres.destroy']))
            <th class="no-link last" style="width:70px"><span class="nobr">Action</span></th>
          @endif
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($polress as $polres)
            <tr>
              <td class="text-center">{{ ++$no }}</td>
              <td class="">{{$polres->nama}}</td>
              <td class="">{{$polres->email}}</td>
              <td class="">{{$polres->alamat}}</td>
              @if(Sentinel::getUser()->hasAnyAccess(['polres.show','polres.edit','polres.destroy']))
                <td class="">
                  @if (Sentinel::getUser()->hasAccess(['polres.show']))
                    <a href="{{route('polres.edit', $polres->id)}}" data-toggle="tooltip" data-placement="left" title="Detail" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['polres.edit']))
                    <a href="{{route('polres.edit', $polres->id)}}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['polres.destroy']))
                    {!! Form::open(['method'=>'DELETE', 'route' => ['polres.destroy', $polres->id], 'style' => 'display:inline']) !!}
                    <button type="submit" name="delete" data-toggle="tooltip" data-placement="right" title="Delete" id="delete-confirm" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                    {!! Form::close() !!}
                  @endif
                </td>
                @endif
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
