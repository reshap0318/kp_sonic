@extends('layouts.frontend')
@section('title')
  List Polres
@stop

@section('content')
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/gantela/vendors/daterangepick/daterangepicker.css') }}" />
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
                    <a href="{{route('polres.show', $polres->id)}}" data-toggle="tooltip" data-placement="left" title="Detail" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
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
  <div id="cetak-setting" class="modal fade bs-example-modal-lg text-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Pengaturan Cetak</h4><div class="modal-body">
          <div class="modal-body text-center">
            <form class="form-horizontal form-label-left" action="{{url('cetak-polres')}}" method="get">
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
      table = $('#tblpolres').DataTable({
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
