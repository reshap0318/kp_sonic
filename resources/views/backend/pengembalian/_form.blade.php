
<div class="form-group">
  {!! Form::label('barang_id', 'Barang *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('peminjaman_id', $peminjaman, null, ['class' => 'js-example-basic-single form-control','multiple'=>'multiple','id'=>'barang_id']) !!}
  </div>
  <button type="button" name="button" class="btn btn-success"> <i class="fa fa-qrcode"></i> </button>
  <button type="button" name="button" class="btn btn-success" onclick="bukamodal()"> <i class="fa fa-search"></i> </button>
</div>

<div class="form-group">
  {!! Form::label('kondisi', 'Kondisi *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
      {{ Form::radio('kondisi', '1', false,['class'=>'flat']) }} Baik &emsp;&emsp;&emsp;
      {{ Form::radio('kondisi', '2', false,['class'=>'flat']) }} Rusak &emsp;&emsp;&emsp;
      {{ Form::radio('kondisi', '3', false,['class'=>'flat']) }} Rusak Berat &emsp;&emsp;&emsp;
      {{ Form::radio('kondisi', '4', false,['class'=>'flat']) }} Dihapuskan
  </div>
</div>

<div class="form-group">
  {!! Form::label('keterangan', 'Keterangan *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::textarea('keterangan', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>
