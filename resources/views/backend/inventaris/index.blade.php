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
          <th>Jenis</th>
          <th>Baik</th>
          <th>Rusak</th>
          <th>Perbaikan</th>
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
              <td class=" ">{{$inventaris->jenis}}</td>
              <td class=" "></td>
              <td class=" "></td>
              <td class=" "></td>
              <td class=" "></td>
              <td class=" last">
                @if (Sentinel::getUser()->hasAccess(['inventaris.edit']))
                  <a href="{{route('inventaris.edit', $inventaris->id)}}" class="btn btn-success btn-xs">edit</a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['inventaris.destroy']))
                  {!! Form::open(['method'=>'DELETE', 'route' => ['inventaris.destroy', $inventaris->id], 'style' => 'display:inline']) !!}
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
      table = $('#tblinventaris').DataTable({
          'columnDefs': [{
             'targets': 0,
             'searchable':false,
             'orderable':false,
            }],
        });
    });

  $("input#delete-confirm").on("click", function(){
      return confirm("Yakin Ingin Menghapus Inventaris Ini?");
  });

</script>
@stop
