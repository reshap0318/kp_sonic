@extends('layouts.frontend')
@section('title')
  List Operator {{$operators->nama}}
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Daftar Operator {{$operators->nama}}</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['operator.create']))
        <a href="{{route('operator.create')}}" class="btn btn-success">New Operator</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tbloperator">
      <thead>
        <tr class="headings">
          <th class="text-center">No</th>
          <th>Nama</th>
          <th>SK</th>
          <th>Polres</th>
          @if(Sentinel::getUser()->hasAnyAccess(['operator.show','operator.edit','operator.destroy']))
            <th class="no-link last" style="width:70px"><span class="nobr">Action</span></th>
          @endif
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($operators->operator as $operator)
            <tr>
              <td class="text-center">{{ ++$no }}</td>
              <td class="">{{$operator->nama}}</td>
              <td class="">{{$operator->no_sk}}</td>
              <td class="">{{$operator->polres->nama}}</td>
              @if(Sentinel::getUser()->hasAnyAccess(['operator.show','operator.edit','operator.destroy']))
                <td class="">
                  @if (Sentinel::getUser()->hasAccess(['operator.show']))
                    <a href="{{route('operator.edit', $operator->id)}}" data-toggle="tooltip" data-placement="left" title="Detail" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['operator.edit']))
                    <a href="{{route('operator.edit', $operator->id)}}" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                  @endif
                  @if (Sentinel::getUser()->hasAccess(['operator.destroy']))
                    {!! Form::open(['method'=>'DELETE', 'route' => ['operator.destroy', $operator->id], 'style' => 'display:inline']) !!}
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
      table = $('#tbloperator').DataTable({
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
      return confirm("Yakin Ingin Menghapus Operator Ini?");
  });

</script>
@stop
