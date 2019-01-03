@extends('layouts.frontend')

@section('title')
	New Inventaris {{optional(Sentinel::getUser()->polres)->nama}}
@stop


@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Create Inventaris {{optional(Sentinel::getUser()->polres)->nama}}<small>isi data * dengan benar</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
{{ Form::open(array('url' => route('inventaris_detail.store'), 'class' => 'form-horizontal','files' => true,'class'=>'form-horizontal form-label-left','data-parsley-validate','id'=>'demo-form2')) }}

          @include('backend.inventarisD._form')

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 text-center">
              <a class="btn btn-primary" href="{{route('inventaris_detail.index',['inventarisId='.$id])}}">Cancel</a>
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
