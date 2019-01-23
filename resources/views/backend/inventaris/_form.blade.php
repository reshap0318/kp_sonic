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
    {!! Form::text('jenis', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','id'=>'tjenis']) !!}
    {!! Form::select('jenis', $kategori, null, ['class' => 'foselect2_single form-control','id'=>'cjenis']) !!}
  </div>
  <a onclick="ganti()" class="btn btn-round btn-primary" data-toggle="tooltip" data-placement="top" title="Ganti Input"><i class="fa fa-exchange"></i></a>
</div>

<script type="text/javascript">
  var s = 0;
  var tjenis = document.getElementById('tjenis');
  var cjenis = document.getElementById('cjenis');
  tjenis.style.display = "none";
  tjenis.disabled = "disabled";
  function ganti() {
    if(cjenis.style.display == "block"){
      tjenis.style.display = "block";
      cjenis.style.display = "none";
      tjenis.disabled = false;
      cjenis.disabled = true;
    }else{
      cjenis.style.display = "block";
      tjenis.style.display = "none";
      tjenis.disabled = true;
      cjenis.disabled = false;
    }
  }
  // tjenis.hide();
</script>
