<div class="form-group">
  {!! Form::label('no_serial', 'Nomor Serial', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('no_serial', null, ['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'1611522012']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('th_perolehan', 'Tahun Perolehan', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('th_perolehan', null, ['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'2019']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('id_jenis', 'Jenis', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('id_jenis', $jenis,null, ['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'---Pilihan Jenis---']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('merek', 'Merek', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('id_merek', $merek,null, ['class'=>'form-control col-md-7 col-xs-12','id'=>'cmerek','placeholder'=>'---Pilihan Merek---']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('type', 'Type', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('type', $type,null, ['class'=>'form-control col-md-7 col-xs-12','id'=>'ctype','placeholder'=>'---Pilihan Type---']) !!}
    {!! Form::text('type',null, ['class'=>'form-control col-md-7 col-xs-12','id'=>'ttype','placeholder'=>'Laptop Geming']) !!}
  </div>
  <button type="button" onclick="gantitype()" name="button" class="btn btn-round btn-primary"><i class="fa fa-exchange"></i></button>
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
    {!! Form::textarea('keterangan',null, ['class'=>'form-control col-md-7 col-xs-12','placeholder'=>'keterangan']) !!}
  </div>
</div>

@section('scripts')
  <script type="text/javascript">
      var ctype = document.getElementById('ctype');
      var ttype = document.getElementById('ttype');

      ctype.disabled=true;
      ctype.style.display = 'none';

      function gantitype() {
        if(ctype.disabled==true){
          ttype.disabled=true;
          ttype.style.display = 'none';
          ctype.disabled=false;
          ctype.style.display = 'block';
        }
        else{
          ttype.disabled=false;
          ttype.style.display = 'block';
          ctype.disabled=true;
          ctype.style.display = 'none';
        }
      }
  </script>
@stop
