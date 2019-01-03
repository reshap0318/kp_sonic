@extends('layouts.frontend')
@section('title')
Users
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>Table design <small>Custom design</small></h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['user.create']))
        <a href="{{route('user.create')}}" class="btn btn-success">New User</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tblUsers">
  <thead>
    <tr class="headings">
      <th class="text-center">
        <input type="checkbox" name="select_all" value="1" id="example-select-all">
      </th>
      <th>Kode </th>
      <th>Polres </th>
      <th>Email </th>
      <th class="no-link last"><span class="nobr">Action</span>
      </th>
      <th class="bulk-actions" colspan="7">
        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
      </th>
    </tr>
  </thead>

  <tbody>
    @foreach($users as $user)
          @if($user->id != Sentinel::getuser()->id)
          <td class="text-center">{{ Form::checkbox('sel', $user->id, null, ['class' => ''])}}</td>
          <td class=" ">{{$user->kode}}</td>
          <td class=" ">{{optional($user->polres)->nama}}</td>
          <td class="">{{optional($user->polres)->email}}</td>
          <td class=" last">
            @if (Sentinel::getUser()->hasAccess(['user.show']))
              <a href="{{route('user.show', $user->id)}}" class="btn btn-success btn-xs">View</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['user.edit']))
              <a href="{{route('user.edit', $user->id)}}" class="btn btn-success btn-xs">edit</a>
            @endif

            @if (Sentinel::getUser()->hasAccess(['user.permissions']))
              <a href="{{route('user.permissions', $user->id)}}" class="btn btn-warning btn-xs">Permissions</a>
            @endif
            @if (Sentinel::getUser()->hasAccess(['user.create']))
              <a href="{{ url("user/qr-code/$user->id") }}" class="btn btn-warning btn-xs">Qr-Code</a>
            @endif

            @if(sizeof($user->activations) == 0)
              @if (Sentinel::getUser()->hasAccess(['user.activate']))
                <a href="{{route('user.activate', $user->id)}}" class="btn btn-primary btn-xs">Activate</a>
              @endif
            @else
              @if (Sentinel::getUser()->hasAccess(['user.deactivate']))
                <a href="{{route('user.deactivate', $user->id)}}" class="btn btn-danger btn-xs">Deactivate</a>
              @endif
            @endif
            @if (Sentinel::getUser()->hasAccess(['user.destroy']))
              {!! Form::open(['method'=>'DELETE', 'route' => ['user.destroy', $user->id], 'style' => 'display:inline']) !!}
              {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm']) !!}
              {!! Form::close() !!}
            @endif
          </td>
          </tr>
          @endif
    @endforeach
  </tbody>
</table>
@if (Sentinel::getUser()->hasAccess(['user.destroy']))
<button id="delete_all" class='btn btn-danger btn-xs'>Delete Selected</button>
@endif
@if (Sentinel::getUser()->hasAccess(['user.activate']))
<button id="activate_all" class='btn btn-primary btn-xs'>Activate Selected</button>
@endif
@if (Sentinel::getUser()->hasAccess(['user.deactivate']))
<button id="deactivate_all" class='btn btn-danger btn-xs'>Deactivate Selected</button>
@endif
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        table = $('#tblUsers').DataTable({
            'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
            }],
          'order': [1, 'asc'],
          dom: 'Bfrtip',
          buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [1, 2, 3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [1, 2, 3]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [1, 2, 3]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [1, 2, 3]
                }
            }
          ]
            });
    });
      // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });
  $("input#delete-confirm").on("click", function(){
        return confirm("Are you sure to delete this user");
    });
  // start Delete All function
  $("#delete_all").click(function(event){
        event.preventDefault();
        if (confirm("Are you sure to Delete Selected?")) {
            var value=get_Selected_id();
            if (value!='') {

                 $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{action('UserController@ajax_all')}}",
                    data: {all_id:value,action:'delete'},
                        success: function(data) {
                          location.reload()
                        }
                    })

                }else{return confirm("You have to select any item before");}
        }
        return false;
   });
  //End Delete All Function
  //Start Deactivate all Function
    $("#deactivate_all").click(function(event){
        event.preventDefault();
        if (confirm("Are you sure to Deactivate Selected ?")) {
            var value=get_Selected_id();
            if (value!='') {

                 $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{action('UserController@ajax_all')}}",
                    data: {all_id:value,action:'deactivate'},
                        success: function(data) {
                          location.reload()
                        }
                    })

                }else{return confirm("You have to select any item before");}
        }
        return false;
    });
    //End Deactivate Function
      //Start Activate all Function
    $("#activate_all").click(function(event){
        event.preventDefault();
        if (confirm("Are you sure to Activate Selected ?")) {
            var value=get_Selected_id();
            if (value!='') {

                 $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{action('UserController@ajax_all')}}",
                    data: {all_id:value,action:'activate'},
                        success: function(data) {
                          location.reload()
                        }
                    })

                }else{return confirm("You have to select any checkbox before");}
        }
        return false;
    });
    //End Activate Function




   function get_Selected_id() {
    var searchIDs = $("input[name=sel]:checked").map(function(){
      return $(this).val();
    }).get();
    return searchIDs;
   }
</script>
@endsection
