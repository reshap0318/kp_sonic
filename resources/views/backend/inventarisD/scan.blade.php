@extends('layouts.frontend')
@section('title')
    Cek Inventaris
@stop

@section('content')
<div class="x_panel">
    <div class="flex text-center">
      <div class="row">
          <canvas id="canvas" width="300" height="300"></canvas>
        </div>
      </div>
      <div class="row">
        <div id="message" class="text-center">
        </div>
      </div>
    </div>
</div>

@stop

@section('scripts')
<script type="text/javascript" src="{{asset('js/qrcodelib.js')}}"></script>
<script type="text/javascript" src="{{asset('js/webcodecamjs.js')}}"></script>
<script type="text/javascript">
	var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
    var arg = {
        resultFunction: function(result) {
          console.log(result.code);
          if (result!='') {
                   $.ajax({
                      type: "POST",
                      cache: false,
                      url : "{{action('InventarisDetailController@ceking')}}",
                      data: {"_token": "{{ csrf_token() }}",data:result.code},
                            success: function(data) {
                              console.log(data);
                            if (data==1) {
                              location.reload();
                              alert('berhasil');
                            }else{
                             return confirm('There is no user with this qr code');
                            }
                          }
                      })

          }
          else{
            return confirm('There is no  data');
          }
        }
    };
    new WebCodeCamJS("canvas").init(arg).play();

    $('#message').html('<span class="text-success send-true">Scanning now....</span>');
</script>
@endsection
