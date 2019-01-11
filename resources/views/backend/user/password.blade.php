@extends('layouts.frontend')

@section('title')
	Edit Password
@stop


@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Form Edit User Password</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
{{ Form::model($user, array('method' => 'PATCH', 'url' => 'edit-password/'.$user->id, 'class' => 'form-horizontal form-label-left', 'files' => true,'data-parsley-validate','id'=>'demo-form2')) }}

          <div class="form-group">
            {!! Form::label('old_password', 'Old Password *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::password('old_password', ['class' => 'form-control col-md-7 col-xs-12']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('new_password', 'New Password*', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::password('new_password', ['class' => 'form-control col-md-7 col-xs-12']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('password_confirm', 'Password Confirm *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
            <div class="col-md-6 col-sm-6 col-xs-12">
              {!! Form::password('password_confirm', ['class' => 'form-control col-md-7 col-xs-12']) !!}
            </div>
          </div>


          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 text-center">
              <a class="btn btn-primary" href="{{route('user.index')}}">Cancel</a>
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
