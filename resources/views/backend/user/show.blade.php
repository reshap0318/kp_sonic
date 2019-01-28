@extends('layouts.frontend')
@section('title')
  Profile {{$user->nama}}
@stop

@section('content')
<div class="x_panel">
  <div class="x_title text-center">
    @if($user->avatar)
      <a href="{{ url('avatar/profile-pict/'.$user->avatar) }}" download="foto-profil-$user->avatar"><img src="{{ url('avatar/profile-pict/'.$user->avatar) }}" alt="..." class="img-circle" style="height: 200px;width: 200px;border: 2px solid" ></a>
    @else
      <a href="{{ asset('/img/lea.png') }}" download="LEA"><img src="{{ asset('/img/lea.png') }}" alt="..." class="img-circle" style="height: 200px;width: 200px;border: 2px solid" ></a>
    @endif
    <div class="clearfix"></div>
  </div>

    <h3 class="text-center">{{$user->nrp_nip}}</h3>
    <div class="flex text-center">
        <div class="col-md-3">
            {!! Form::label('nama','Nama :') !!}
            {{$user->nama}}
         </div>
         <div class="col-md-3">
            {!! Form::label('satker', 'Satuan Kerja :') !!}
            {{optional($user->satker)->nama}}
         </div>
         <div class="col-md-3">
            {!! Form::label('jabatan', 'Jabatan :') !!}
            {{optional($user->jabatan)->nama}}
         </div>
         <div class="col-md-3">
            {!! Form::label('pangkat', 'Pangkat :') !!}
            {{optional($user->pangkat)->nama}}
         </div>
    </div>
    <br>
    <br>
    <div class="flex text-center">
      <div class="col-md-12">
         {!! Form::label('last_login', 'Login Terakhir :') !!}
         {{$user->last_login}}
      </div>
    </div>
</div>

<div class="text-center">
  @if($user->id==Sentinel::getuser()->id)
    <a href="{{url('edit-profil')}}" class="btn btn-primary">Edit Profil</a>
  @endif
</div>


@stop
