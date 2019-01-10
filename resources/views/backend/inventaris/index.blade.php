@extends('layouts.frontend')
@section('title')
  List Inventaris Polres {{optional(Sentinel::getUser()->polres)->nama}}
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Daftar Inventaris {{optional(Sentinel::getUser()->polres)->nama}}</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['inventaris.create']))
        <a href="{{route('inventaris.create')}}" class="btn btn-success">New Inventaris</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tblinventaris">
      <thead>
        <tr class="headings">
          <th class="text-center">No</th>
          @if(Sentinel::getuser()->id==1)
          <th>Polres</th>
          @endif
          <th>Jenis</th>
          <th>Baik</th>
          <th>Rusak</th>
          <th>Rusak Berat</th>
          <th>Total</th>
          <th class="no-link last"><span class="nobr">Action</span></th>
          <th class="bulk-actions" colspan="7">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
          </th>
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($inventariss as $inventaris)
              <td class=" text-center">{{ ++$no }}</td>
              @if(Sentinel::getuser()->id==1)
              <td class=" ">{{optional($inventaris->polres)->nama}}</td>
              @endif
              <td class=" ">{{$inventaris->jenis}}</td>
              <td class=" ">{{$inventaris->baik}} Buah</td>
              <td class=" ">{{$inventaris->rusak}} Buah</td>
              <td class=" ">{{$inventaris->rusakberat}} Buah</td>
              <td class=" ">{{$inventaris->baik + $inventaris->rusak + $inventaris->rusakberat}} Buah</td>
              <td class=" last">
                @if (Sentinel::getUser()->hasAccess(['inventaris.show']))
                  <a href="{{route('inventaris.show', $inventaris->id)}}"  name="delete" data-toggle="tooltip" data-placement="right" title="Detail" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['inventaris.edit']))
                  <a href="{{route('inventaris.edit', $inventaris->id)}}"  name="delete" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['inventaris.destroy']))
                  {!! Form::open(['method'=>'DELETE', 'route' => ['inventaris.destroy', $inventaris->id], 'style' => 'display:inline']) !!}
                  <button type="submit" name="delete" data-toggle="tooltip" data-placement="right" title="Delete" id="delete-confirm" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
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
      table = $('#tblinventaris').DataTable({
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
                      columns: [0, 1, 2, 3, 4, 5, 6]
                  }
              },
              {
                  extend: 'print',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6]
                  }
              },
              {
                  extend: 'csv',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6]
                  }
              },
              {
                  extend: 'excel',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6]
                  }
              },
              {
                  extend: 'pdf',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6]
                  }
              }
            ]
        });
    });

  $("input#delete-confirm").on("click", function(){
      return confirm("Yakin Ingin Menghapus Inventaris Ini?");
  });

</script>
@stop
