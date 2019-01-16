@extends('layouts.frontend')
@section('title')
  List Operator {{optional(Sentinel::getuser()->polres)->nama}}
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Daftar Operator {{optional(Sentinel::getuser()->polres)->nama}}</h2>
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
          <th>Aktivasi</th>
          @if(Sentinel::getUser()->hasAnyAccess(['operator.show','operator.edit','operator.destroy']))
            <th class="no-link last" style="width:150px"><span class="nobr">Action</span></th>
          @endif
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($operators as $operator)
            <tr>
              <td class="text-center">{{ ++$no }}</td>
              <td class="">{{$operator->nama}}</td>
              <td class="">{{$operator->no_sk}}</td>
              <td class="">{{$operator->polres->nama}}</td>
              <td class="">@if($operator->aktivasi==1)
                Aktiv
              @else
                Tidak Aktiv
              @endif</td>
              @if(Sentinel::getUser()->hasAnyAccess(['operator.show','operator.edit','operator.destroy']))
                <td class="">
                  <a data-toggle="modal" data-target="#{{$operator->id}}" class="btn btn-success btn-xs"><i class="fa fa-file-image-o"></i></a>
                  @if (Sentinel::getUser()->hasAccess(['operator.edit']))
                    <a data-toggle="tooltip" href="{{route('operator.aktiv',$operator->id)}}" data-placement="left" title="Aktivasi" class="btn btn-success btn-xs" name="a"><i class="fa fa-key"></i></a>
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
            <div id="{{$operator->id}}" class="modal fade bs-example-modal-lg text-center" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">NO : {{$operator->no_sk}}</h4><div class="modal-body">
                    <div class="modal-body text-center">
                      <a href="{{ url('avatar/bukti-pict/'.$operator->foto_sk) }}" download="SK-{{$operator->no_sk}}"><img src="{{ url('avatar/bukti-pict/'.$operator->foto_sk) }}" style="height:842px; width:595px"></a>
                      <br>
                      <span>Click to Download</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@if($optidak!='a')
<div class="x_panel">
  <div class="x_title">
    <h2>Daftar Operator Tidak Aktiv {{optional(Sentinel::getuser()->polres)->nama}}</h2>
    <ul class="nav navbar-right panel_toolbox">
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tbloperatortidak">
      <thead>
        <tr class="headings">
          <th class="text-center">No</th>
          <th>Nama</th>
          <th>SK</th>
          <th>Polres</th>
          <th>Aktivasi</th>
          @if(Sentinel::getUser()->hasAnyAccess(['operator.show','operator.edit','operator.destroy']))
            <th class="no-link last" style="width:150px"><span class="nobr">Action</span></th>
          @endif
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($optidak as $operator)
            <tr>
              <td class="text-center">{{ ++$no }}</td>
              <td class="">{{$operator->nama}}</td>
              <td class="">{{$operator->no_sk}}</td>
              <td class="">{{$operator->polres->nama}}</td>
              <td class="">@if($operator->aktivasi==1)
                Aktiv
              @else
                Tidak Aktiv
              @endif</td>
              @if(Sentinel::getUser()->hasAnyAccess(['operator.show','operator.edit','operator.destroy']))
                <td class="">
                  <a data-toggle="modal" data-target="#{{$operator->id}}" class="btn btn-success btn-xs"><i class="fa fa-file-image-o"></i></a>
                  @if (Sentinel::getUser()->hasAccess(['operator.edit']))
                    <a data-toggle="tooltip" href="{{route('operator.aktiv',$operator->id)}}" data-placement="left" title="Aktivasi" class="btn btn-success btn-xs" name="a"><i class="fa fa-key"></i></a>
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
            <div id="{{$operator->id}}" class="modal fade bs-example-modal-lg text-center" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">NO : {{$operator->no_sk}}</h4><div class="modal-body">
                    <div class="modal-body text-center">
                      <a href="{{ url('avatar/bukti-pict/'.$operator->foto_sk) }}" download="SK-{{$operator->no_sk}}"><img src="{{ url('avatar/bukti-pict/'.$operator->foto_sk) }}" style="height:842px; width:595px"></a>
                      <br>
                      <span>Click to Download</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif
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

    $(document).ready(function(){
      table = $('#tbloperatortidak').DataTable({
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
