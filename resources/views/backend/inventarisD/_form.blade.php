<div class="form-group">
  {!! Form::label('kode', 'Kode Inventaris *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('kode', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('kondisi', 'Kondisi Inventaris *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
      {{ Form::radio('kondisi', '1', false,['class'=>'flat']) }} Baik &emsp;&emsp;&emsp;
      {{ Form::radio('kondisi', '2', false,['class'=>'flat']) }} Rusak &emsp;&emsp;&emsp;
      {{ Form::radio('kondisi', '3', false,['class'=>'flat']) }} Rusak Berat
  </div>
</div>
{!! Form::hidden('inventaris_id', $id, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
