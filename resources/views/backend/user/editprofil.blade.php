@extends('layouts.frontend')
@section('title')
  Edit Profile {{$user->kode}}
@stop

@section('content')
<div class="row">
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        {{ Form::model($user, array('method' => 'PATCH', 'url' => 'edit-profil/'.$user->id, 'class' => 'form-horizontal form-label-left', 'files' => true,'data-parsley-validate','id'=>'demo-form2')) }}


            <div class="form-group">
              {!! Form::label('username', 'Username *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('username', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('kode', 'Kode Akun *', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
              <div class="col-md-6 col-sm-6 col-xs-12">
                {!! Form::text('kode', null, ['class' => 'form-control','class'=>'form-control col-md-7 col-xs-12']) !!}
              </div>
            </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 text-center">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <div class="clearfix"></div>
      </div>
      <div class="x_content text-center">
        <img src="{{ asset('/img/lea.png') }}" alt="..." class="" style="height: 147px;width: 147px">

        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 text-center">
            {{ Form::open(array('url' => 'user/ganti-profil/'.$user->id, 'class' => 'form-horizontal','files' => true,'style'=>'display:inline','id'=>'ffoto')) }}
                <input type="file" name="avatar" value="" onchange="simpan()" style="display:none" id="bfoto">
                <button type="button" onclick="upload()" class="btn btn-success">Ganti foto</button>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="text-center">
  <a href="{{url('profil')}}" class="btn btn-primary">Kembali</a>
</div>
@stop
@section('scripts')
    <script>
        function upload() {
          document.getElementById("bfoto").click();
        }

        function simpan() {
          document.getElementById("ffoto").submit();
        }
    </script>
@stop
