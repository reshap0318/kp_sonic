@if(!SentineL::getuser()->polres_id)
<div class="form-group">
  {!! Form::label('polres_id', 'Polres *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('polres_id', $polres, null, ['class' => 'foselect2_single form-control']) !!}
  </div>
</div>
@endif

  <div class="form-group">
    {!! Form::label('tanggal', 'Tanggal *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
      @if($aksi=='create')
        {!! Form::text('tanggal', null, ['class'=>'form-control has-feedback-left col-md-7 col-xs-12','id'=>'single_cal1','aria-describedby'=>'inputSuccess2Status']) !!}
        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
        <span id="inputSuccess2Status" class="sr-only">(success)</span>
      @else
      {!! Form::text('tanggal', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','readonly'=>'readonly']) !!}
      @endif
    </div>
</div>
<div class="form-group">
  {!! Form::label('piket', 'Operator *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('piket[]', $operator, null, ['class' => 'js-example-basic-single form-control','multiple'=>'multiple']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('panggilan_terselesaikan', 'Jumlah Panggilan Terselesaikan *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('panggilan_terselesaikan', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','onkeypress'=>'return hanyaAngka(event)']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('panggilan_prank', 'Jumlah Panggilan Prank *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('panggilan_prank', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','onkeypress'=>'return hanyaAngka(event)']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('panggilan_tidak_terjawab', 'Jumlah Panggilan Tidak Terangkat *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('panggilan_tidak_terjawab', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','onkeypress'=>'return hanyaAngka(event)']) !!}
  </div>
</div>
