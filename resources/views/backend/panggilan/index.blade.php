@extends('layouts.frontend')
@section('title')
  Laporan Panggilan {{optional(Sentinel::getuser()->polres)->nama}}
@stop

@section('content')
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/gantela/vendors/daterangepick/daterangepicker.css') }}" />
<div class="x_panel">
  <div class="x_title">
    <h2>Laporan Panggilan {{optional(Sentinel::getuser()->polres)->nama}}</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['panggilan.create']) )
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
          <th>Tanggal</th>
          <th>Petugas</th>
          <th>Operator</th>
          <th>Polres</th>
          <th>PT (buah)</th>
          <th>PP(buah)</th>
          <th>PTT(buah)</th>
          <th>TP(buah)</th>
          @if(Sentinel::getUser()->hasAnyAccess(['panggilan.edit','panggilan.destroy']))
            <th class="no-link last"><span class="nobr">Action</span></th>
            <th class="bulk-actions" colspan="7">
              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
            </th>
          @endif
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($panggilans as $panggilan)
          <tr>
              <td class=" text-center">{{ ++$no }}</td>
              <td class=" ">{{$panggilan->tanggal}}</td>
              <td class=" ">{{optional($panggilan->user)->nama}}</td>
              <td class=" ">
                @foreach($panggilan->piket as $piket)
                  {{$piket}},
                @endforeach
              </td>
              <td class=" ">{{optional($panggilan->polres)->nama}}</td>
              <td class=" text-center">{{$panggilan->panggilan_terselesaikan}}</td>
              <td class=" text-center">{{$panggilan->panggilan_prank}}</td>
              <td class=" text-center">{{$panggilan->panggilan_tidak_terjawab}}</td>
              <td class=" text-center">{{$panggilan->panggilan_terselesaikan + $panggilan->panggilan_tidak_terjawab + $panggilan->panggilan_prank}}</td>
              @if(Sentinel::getUser()->hasAnyAccess(['panggilan.edit','panggilan.destroy']))
                <td class=" last">
                @if (Sentinel::getUser()->hasAccess(['panggilan.edit']))
                  <a href="{{route('panggilan.edit', $panggilan->id)}}" data-toggle="tooltip" data-placement="right" title="Edit" class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['panggilan.destroy']))
                  {!! Form::open(['method'=>'DELETE', 'route' => ['panggilan.destroy', $panggilan->id], 'style' => 'display:inline']) !!}
                    <button type="submit" name="delete" data-toggle="tooltip" data-placement="left" title="Delete" id="delete-confirm" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}
                @endif
              @endif
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="text-center">
    <div class="col-md-3">
      {!! Form::label('nama','*PT :') !!} Panggilan Terselesaikan
    </div>
    <div class="col-md-3">
     {!! Form::label('nama','*PP :') !!} Panggilan Prank
    </div>
    <div class="col-md-3">
      {!! Form::label('nama','*TP :') !!} Total Panggilan
    </div>
    <div class="col-md-3">
      {!! Form::label('nama','*PTT :') !!} Panggilan Tidak Terjawab <br>
    </div>
  </div>
  <div id="cetak-setting" class="modal fade bs-example-modal-lg text-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Pengaturan Cetak</h4><div class="modal-body">
          <div class="modal-body text-center">
            <form class="form-horizontal form-label-left" action="{{url('cetak-panggilan')}}" method="get">
              <script type="text/javascript">
                $(function() {

                    var start = moment().startOf('month');
                    var end = moment().endOf('month');

                    function cb(start, end) {
                        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    }

                    $('#reportrange').daterangepicker({
                        startDate: start,
                        endDate: end,
                        ranges: {
                           'Harian': [moment(), moment()],
                           'Bulanan': [moment().startOf('month'), moment().endOf('month')],
                           'Tahunan': [moment().startOf('year'), moment().endOf('year')]
                        }
                    }, cb);

                    cb(start, end);

                });
              </script>
              <div class="form-group">
                {!! Form::label('waktu', 'Waktu *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! Form::text('waktu', 01/20/2018 - 01/25/2018, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','id'=>'reportrange']) !!}
                </div>
              </div>
              <div class="form-group">
                  {!! Form::label('polres_id', 'Polres *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! Form::select('polres_id', $polres, null, ['class' => 'foselect2_single form-control','placeholder'=>'Semua']) !!}
                </div>
              </div>
              <div class="form-group">
                  {!! Form::label('kategori', 'Urutkan Berdasarkan *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                  {!! Form::select('kategori', ['tanggal'=>'Tanggal','polres_id'=>'Polres','panggilan_terselesaikan'=>'Panggilan Terselesaikan'], null, ['class' => 'foselect2_single form-control']) !!}
                </div>
              </div>
              <button type="submit" class="btn btn-success">Cetak</button>
            </form>
          </div>
        </div>
      </div>
    </div>
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
            dom: 'Bfrtip',
            buttons: [
              @if(Sentinel::inRole('2'))
              {
                  text: 'Cetak Laporan',
                  className: 'btn-success',
                  action: function(e, dt, node, config)
                  {
                    $('#cetak-setting').modal('show');
                  }
              },
              @endif
              {
                  extend: 'copy',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                  }
              },
              @if(!Sentinel::inRole('2'))
              {
                  extend: 'print',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                  }
              },
              @endif
              {
                  extend: 'csv',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                  }
              },
              {
                  extend: 'excel',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                  }
              },
              {
                  extend: 'pdf',
                  exportOptions: {
                      columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                  }
              }
            ]
        });
    });

  $("input#delete-confirm").on("click", function(){
      return confirm("Yakin Ingin Menghapus Laporan Panggilan Ini?");
  });

</script>
@stop
