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

@include('toast::messages-jquery')
