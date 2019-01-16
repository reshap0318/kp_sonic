@if(!SentineL::getuser()->polres_id)
<div class="form-group">
  {!! Form::label('polres_id', 'Polres *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('polres_id', $polres, null, ['class' => 'foselect2_single form-control']) !!}
  </div>
</div>
@endif

<div class="form-group">
  {!! Form::label('jenis', 'Jenis Inventaris *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('jenis', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>
