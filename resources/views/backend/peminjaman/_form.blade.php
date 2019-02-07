
<div class="form-group">
  {!! Form::label('nrp_nip', 'Penerima *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('nrp_nip', $user, null, ['class' => 'js-example-basic-single form-control']) !!}
  </div>
  <button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user"> <i class="fa fa-plus"></i> </button>
</div>
<div class="form-group">
  {!! Form::label('barang_id', 'Barang *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('barang_id[]', $barang, null, ['class' => 'js-example-basic-single form-control','multiple'=>'multiple','id'=>'barang_id']) !!}
  </div>
  <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target="#cari_barang"> <i class="fa fa-search"></i> </button>
</div>
<div class="form-group">
  {!! Form::label('keterangan', 'Keterangan *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::textarea('keterangan', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>
<input id="hiden" type="hidden" name="barang_id" value="">
