@extends('layouts.frontend')
@section('title')
  List Laporan Panggilan
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Daftar Laporan Panggilan</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['panggilan.create']))
        <a href="{{route('panggilan.create')}}" class="btn btn-success">New Laporan Panggilan</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tblpanggilan">
      <thead>
        <tr class="headings">
          <th class="text-center">No</th>
          <th>Nama Petugas</th>
          <th>Polres</th>
          <th>Panggilan Terjawab</th>
          <th>Panggilan Tidak Terkawab</th>
          <th>Total Panggilan</th>
          <th>Tanggal</th>
          <th class="no-link last"><span class="nobr">Action</span></th>
          <th class="bulk-actions" colspan="7">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
          </th>
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($panggilans as $panggilan)
              <td class=" text-center">{{ ++$no }}</td>
              <td class=" ">{{$panggilan->nama}}</td>
              <td class=" ">{{optional($panggilan->polres)->nama}}</td>
              <td class=" ">{{$panggilan->panggilan_terjawab}} Buah</td>
              <td class=" ">{{$panggilan->panggilan_tidak_terjawab}} Buah</td>
              <td class=" ">{{$panggilan->panggilan_terjawab + $panggilan->panggilan_tidak_terjawab}} Buah</td>
              <td class=" ">{{$panggilan->updated_at}}</td>
              <td class=" last">
                @if (Sentinel::getUser()->hasAccess(['panggilan.edit']))
                  <a href="{{route('panggilan.edit', $panggilan->id)}}" class="btn btn-success btn-xs">edit</a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['panggilan.destroy']))
                  {!! Form::open(['method'=>'DELETE', 'route' => ['panggilan.destroy', $panggilan->id], 'style' => 'display:inline']) !!}
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
      table = $('#tblpanggilan').DataTable({
          'columnDefs': [{
             'targets': 0,
             'searchable':false,
             'orderable':false,
            }],
        });
    });

  $("input#delete-confirm").on("click", function(){
      return confirm("Yakin Ingin Menghapus Laporan Panggilan Ini?");
  });

</script>
@stop
