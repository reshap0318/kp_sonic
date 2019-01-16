@if(!SentineL::getuser()->polres_id)
<div class="form-group">
  {!! Form::label('polres_id', 'Polres *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::select('polres_id', $polres, null, ['class' => 'foselect2_single form-control']) !!}
  </div>
</div>
@endif

<div class="form-group">
  {!! Form::label('nama[]', 'Nama*', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
@if($fungsi=='create')
    {!! Form::text('nama[]', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','disabled'=>'disabled','style'=>'display:none','id'=>'tnama1']) !!}

    {!! Form::select('nama[]', $ope, null, ['class' => 'foselect2_single form-control','id'=>'cnama1']) !!}
@else
    {!! Form::text('nama[]', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','id'=>'tnama1']) !!}
@endif
  </div>
  @if($fungsi=='create')
    <a onclick="ganti(1)" class="btn btn-round btn-primary" data-toggle="tooltip" data-placement="top" title="Ganti Input"><i class="fa fa-exchange"></i></a>
    <a onclick="tambah()" class="btn btn-round btn-danger" data-toggle="tooltip" data-placement="bottom" title="Tambah Inputan"><i class="fa fa-plus-circle"></i></a>
  @endif
</div>

<div id="fnama">

</div>

<div class="form-group">
  {!! Form::label('no_sk', 'SK Operator *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::text('no_sk', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('foto_sk', 'Foto Sk *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
  <div class="col-md-6 col-sm-6 col-xs-12">
    {!! Form::file('foto_sk', null, ['class'=>'form-control']) !!}
  </div>
</div>

<script type="text/javascript">

  var i = 0;
  var fnama = document.getElementById('fnama');
  function ganti(s) {
    var cnama = document.getElementById("cnama"+s);
    var tnama = document.getElementById("tnama"+s);
    if(i==0){
      i=1;
      cnama.style.display = "none";
      cnama.disabled = true;
      tnama.style.display = "block";
      tnama.disabled = false;
      console.log([i,cnama,tnama]);
    }else{
      i=0;
      tnama.style.display = "none";
      tnama.disabled = true;
      cnama.style.display = "block";
      cnama.disabled = false;
      console.log([i,cnama,tnama]);
    }
  }
</script>

<script type="text/javascript">

  var k = 0;
  function tambah() {
    if(k<=1){
      k = k+1;
    }
    var s = null;
    for (var z = 0; z < k; z++) {
      if(z==0){
        s = '<div class="form-group">'+
          '{!! Form::label('nama[]', 'Nama1*', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}'+
          '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '{!! Form::text('nama[]', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','disabled'=>'disabled','style'=>'display:none','id'=>'tnama2']) !!}'+
            '{!! Form::select('nama[]', $ope, null, ['class' => 'foselect2_single form-control','id'=>'cnama2']) !!}'+
          '</div>'+
          '<a onclick="ganti('+2+')" class="btn btn-round btn-primary" data-toggle="tooltip" data-placement="top" title="Ganti Input"><i class="fa fa-exchange"></i></a>'+
        '</div>';
      }else{
        s = s+'<div class="form-group">'+
          '{!! Form::label('nama[]', 'Nama2*', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}'+
          '<div class="col-md-6 col-sm-6 col-xs-12">'+
            '{!! Form::text('nama[]', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','disabled'=>'disabled','style'=>'display:none','id'=>'tnama3']) !!}'+
            '{!! Form::select('nama[]', $ope, null, ['class' => 'foselect2_single form-control','id'=>'cnama3']) !!}'+
          '</div>'+
          '<a onclick="ganti('+3+')" class="btn btn-round btn-primary" data-toggle="tooltip" data-placement="top" title="Ganti Input"><i class="fa fa-exchange"></i></a>';
        '</div>';
      }
    }
    fnama.innerHTML = s;
  }
</script>
