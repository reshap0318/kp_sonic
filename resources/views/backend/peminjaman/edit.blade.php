@extends('layouts.frontend')

@section('title')
	Serah Terima Barang {{$peminjaman->barang->no_serial}}
@stop


@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Peminjaman Barang<small>isi data * dengan benar</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
{{ Form::model($peminjaman, array('method' => 'PATCH', 'url' => route('serah-terima.update', $peminjaman->id), 'class' => 'form-horizontal form-label-left', 'files' => true,'data-parsley-validate','id'=>'demo-form2')) }}

					<div class="form-group">
						{!! Form::label('tanggal', 'Tanggal *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
						<div class="col-md-6 col-sm-6 col-xs-12">
								{!! Form::text('tanggal', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','readonly'=>'readonly']) !!}
						</div>
					</div>

          @include('backend.peminjaman._form')
					@include('backend.peminjaman.table')

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 text-center">
              <a class="btn btn-primary" href="{{route('serah-terima.index')}}">Cancel</a>
			  			<button class="btn btn-primary" type="reset">Reset</button>
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
{{ Form::close() }}
      </div>
    </div>
  </div>
</div>
@stop

@section('select')
	<script type="text/javascript">
		$(".js-example-basic-single").select2({
			maximumSelectionLength: 1
		});
	</script>
@stop
