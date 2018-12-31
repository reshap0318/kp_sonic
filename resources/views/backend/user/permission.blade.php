@extends('layouts.frontend')

@section('style')
	<link href="{{ URL::asset('/gantela/vendors/sumoselect/sumoselect.css') }}" rel="stylesheet" />
@stop

@section('title')
	Permission {{$user->nama}}
@stop


@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{$user->nama}} <small>Permission</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
{{ Form::open(array('url' => route('user.simpan',$user->id),'files' => true,'class'=>'form-horizontal','data-parsley-validate','id'=>'demo-form2')) }}

          @foreach($actions as $action)
            <div class=" row form-group col-md-6">
                <?php $first= array_values($action)[0];
                    $firstname =explode(".", $first)[0];
                ?>
                {{Form::label($firstname, $firstname, ['class' => 'form col-md-3 capital_letter'])}}
                    <select name="permissions[]" class="select" multiple="multiple">
                        @foreach($action as $act)
                            @if(explode(".", $act)[0]=="api")
                                <option value="{{$act}}" {{array_key_exists($act, $user->permissions)?"selected":""}}>
                                {{isset(explode(".", $act)[2])?explode(".", $act)[1].".".explode(".", $act)[2]:explode(".", $act)[1]}}</option>
                            @else
                                <option value="{{$act}}" {{array_key_exists($act, $user->permissions)?"selected":""}}>

                                {{explode(".", $act)[1]}}

                                </option>
                            @endif
                        @endforeach
                    </select>
            </div>
          @endforeach
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

@section('scripts')
  <script src="{{ URL::asset('/gantela/vendors/sumoselect/jquery.sumoselect.js') }}"></script>
  <script type="text/javascript">
      $('.select').SumoSelect({ selectAll: true, placeholder: 'Nothing selected' });
  </script>
@endsection
