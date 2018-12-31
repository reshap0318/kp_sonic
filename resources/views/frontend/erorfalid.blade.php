@if (count($errors) > 0)
    <div class="form-group">
        <div class="col-sm-12">
            <div class="alert alert-danger">
                <strong>Upsss !</strong> There is an error...<br /><br />
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if(Session::has('toasts'))
	@foreach(Session::get('toasts') as $toast)
		<div class="alert alert-{{ $toast['level'] }} alert-dismissible fade show" role="alert" id="flash-message" >
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

			@if(!is_null($toast['title']))
				<strong>{{ $toast['title'] }}</strong>
			@endif

			{{ $toast['message'] }}
		</div>
	@endforeach
@endif