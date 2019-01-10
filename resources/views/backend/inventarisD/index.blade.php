@extends('layouts.frontend')
@section('title')
  List Inventaris {{optional($details->polres)->nama}}
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Daftar Inventaris {{$details->jenis}} {{optional($details->polres)->nama}}</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['inventaris_detail.create']))
        <a href="{{route('inventaris_detail.create',['inventarisId='.$details->id])}}" class="btn btn-success">New Inventaris {{$details->jenis}}</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <table class="table table-bordered table-striped table-hover" id="tbldetail">
      <thead>
        <tr class="headings">
          <th class="text-center">No</th>
          <th>Koden Barang</th>
          <th>Kondisi</th>
          <th class="no-link last"><span class="nobr">Action</span></th>
          <th class="bulk-actions" colspan="7">
            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
          </th>
        </tr>
      </thead>
        <?php $no=0?>
      <tbody>
        @foreach($details->detail as $detail)
              <td class=" text-center">{{ ++$no }}</td>
              <td class=" ">{{$detail->kode}}</td>
              <td class=" ">@if($detail->kondisi==1)
                Baik
              @elseif($detail->kondisi==2)
                Rusak
              @elseif($detail->kondisi==3)
                Rusak Berat
              @endif</td>
              <td class=" last">
                  <a data-toggle="modal" data-target="#{{$detail->id}}" class="btn btn-success btn-xs">QR-Code</a>

                @if (Sentinel::getUser()->hasAccess(['inventaris_detail.edit']))
                  <a href="{{route('inventaris_detail.edit', $detail->id)}}" data-toggle="tooltip" data-placement="right" title="Detail" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['inventaris_detail.destroy']))
                  {!! Form::open(['method'=>'DELETE', 'route' => ['inventaris_detail.destroy', $detail->id], 'style' => 'display:inline']) !!}
                    <button type="submit" name="delete" data-toggle="tooltip" data-placement="left" title="Delete" id="delete-confirm" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}
                @endif
              </td>
              </tr>
              <div id="{{$detail->id}}" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel2">QRCode {{$detail->kode}}</h4><div class="modal-body">
                      <div class="modal-body text-center">
                        <a href="data:image/png;base64, {!! base64_encode(QrCode::format('png')->color(38, 38, 38, 0.85)->backgroundColor(255, 255, 255, 0.82)->size(200)->errorCorrection('H')->generate($detail->kode)) !!}" download="QRCODE-{{$detail->kode}}"><img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->color(38, 38, 38, 0.85)->backgroundColor(255, 255, 255, 0.82)->size(200)->errorCorrection('H')->generate($detail->kode)) !!} "></a>
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
<div class="text-center">
    <a href="{{route('inventaris.index')}}" class="btn btn-primary">Kembali</a>
</div>
@endsection


@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
      table = $('#tbldetail').DataTable({
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
                      columns: [0, 1, 2]
                  }
              },
              {
                  extend: 'print',
                  exportOptions: {
                      columns: [0, 1, 2]
                  }
              },
              {
                  extend: 'csv',
                  exportOptions: {
                      columns: [0, 1, 2]
                  }
              },
              {
                  extend: 'excel',
                  exportOptions: {
                      columns: [0, 1, 2]
                  }
              },
              {
                  extend: 'pdf',
                  exportOptions: {
                      columns: [0, 1, 2]
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
