@extends('layouts.frontend')

@section('title')
	Edit Inventaris {{$detail->kode}} - {{$detail->inventaris->jenis}} - {{optional(Sentinel::getUser()->polres)->nama}}
@stop


@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Edit Inventaris {{$detail->kode}} - {{$detail->inventaris->jenis}} - {{optional(Sentinel::getUser()->polres)->nama}}<small>isi data * dengan benar</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
{{ Form::model($detail, array('method' => 'PATCH', 'url' => route('inventaris_detail.update', $detail->id), 'class' => 'form-horizontal form-label-left', 'files' => true,'data-parsley-validate','id'=>'demo-form2')) }}


        <div class="form-group">
          {!! Form::label('inventaris_id', 'Jenis Inventaris *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
          <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::select('inventaris_id', $jenis, null, ['class' => 'foselect2_single form-control','disabled'=>'disabled']) !!}
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('kode', 'Kode Inventaris *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
          <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::text('kode', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','disabled'=>'disabled']) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('kondisi', 'Kondisi Inventaris *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
          <div class="col-md-6 col-sm-6 col-xs-12">
              {{ Form::radio('kondisi', '1', false,['class'=>'flat','disabled'=>'disabled']) }} Baik &emsp;&emsp;&emsp;
              {{ Form::radio('kondisi', '2', false,['class'=>'flat','disabled'=>'disabled']) }} Rusak &emsp;&emsp;&emsp;
              {{ Form::radio('kondisi', '3', false,['class'=>'flat','disabled'=>'disabled']) }} Rusak Berat
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('keterangan', 'Keterangan', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
          <div class="col-md-6 col-sm-6 col-xs-12">
            {!! Form::textarea('keterangan', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12','disabled'=>'disabled']) !!}
          </div>
        </div>


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 text-center">
							@if($detail->inventaris_id=='all')
								<a class="btn btn-primary" href="{{route('inventaris.index')}}">Cancel</a>
							@else
								<a class="btn btn-primary" href="{{route('inventaris_detail.index',['inventarisId='.$detail->inventaris_id])}}">Cancel</a>
							@endif
			  			<button class="btn btn-primary" type="reset">Edit</button>
            </div>
          </div>
{{ Form::close() }}
      </div>
    </div>
  </div>
</div>
@stop
