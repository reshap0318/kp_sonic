<div class="form-group">
  {!! Form::label('nama', 'Nama Petugas Piket *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('nama', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('pangkat', 'Pangkat *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('pangkat', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('nrp', 'NRP *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('nrp', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','onkeypress'=>'return hanyaAngka(event)']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('panggilan_terjawab', 'Jumlah Panggilan Terangkat *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('panggilan_terjawab', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','onkeypress'=>'return hanyaAngka(event)']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('panggilan_tidak_terjawab', 'Jumlah Panggilan Tidak Terangkat *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('panggilan_tidak_terjawab', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','onkeypress'=>'return hanyaAngka(event)']) !!}
  </div>
</div>
