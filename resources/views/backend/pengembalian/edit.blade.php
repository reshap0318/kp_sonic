@extends('layouts.frontend')

@section('title')
	Pengembalian Barang
@stop


@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Pengembalian Barang<small>isi data * dengan benar</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
{{ Form::model($pengembalian, array('method' => 'PATCH', 'url' => route('pengembalian.update', $pengembalian->id), 'class' => 'form-horizontal form-label-left', 'files' => true,'data-parsley-validate','id'=>'demo-form2')) }}

					<div class="form-group">
						{!! Form::label('tanggal', 'Tanggal *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
						<div class="col-md-6 col-sm-6 col-xs-12">
								{!! Form::text('tanggal', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','readonly'=>'readonly']) !!}
						</div>
					</div>
          @include('backend.pengembalian._form')
					@include('backend.pengembalian.table')

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 text-center">
              <a class="btn btn-primary" href="{{route('pengembalian.index')}}">Cancel</a>
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
