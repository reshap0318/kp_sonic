@extends('layouts.frontend')

@section('title')
  Role
@stop

@section('content')
<div class="x_panel">
  <div class="x_title">
    <h2>List Role Atau Jabatan</h2>
    <ul class="nav navbar-right panel_toolbox">
      @if (Sentinel::getUser()->hasAccess(['role.create']))
        <a href="{{route('role.create')}}" class="btn btn-success">New Role</a>
      @endif
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
<table class="table table-bordered table-striped table-hover" id="tblRole">
  <thead>
    <tr class="headings">
      <th class="text-center">
        No
      </th>
      <th>Name </th>
      <th>Slug </th>
      <th class="no-link last"><span class="nobr">Action</span>
      </th>
      <th class="bulk-actions" colspan="7">
        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
      </th>
    </tr>
  </thead>
  <?php $no=0?>
  <tbody>
    @foreach($roles as $role)
      @if($role->id != 1)
        <tr>
            <td class=" text-center">{{ ++$no }}</td>
            <td class=" ">{{$role->name}}</td>
            <td class=" ">{{$role->slug}}</td>
            <td class=" last">
              @if (Sentinel::getUser()->hasAccess(['role.show']))
                <a href="{{route('role.show', $role->slug)}}" class="btn btn-success btn-xs">View</a>
              @endif
              @if (Sentinel::getUser()->hasAccess(['role.edit']))
                <a href="{{route('role.edit', $role->id)}}" class="btn btn-success btn-xs">edit</a>
              @endif

              @if (Sentinel::getUser()->hasAccess(['role.permissions']))
                <a href="{{route('role.permissions', $role->id)}}" class="btn btn-warning btn-xs">Permissions</a>
              @endif
              @if (Sentinel::getUser()->hasAccess(['role.destroy']))
                {!! Form::open(['method'=>'DELETE', 'route' => ['role.destroy', $role->id], 'style' => 'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm']) !!}
                {!! Form::close() !!}
              @endif
            </td>
          </tr>
        @endif
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        table = $('#tblRole').DataTable({
            'columnDefs': [{
               'targets': 0,
               'searchable':false,
               'orderable':false,
            }],
            dom: 'Bfrtip',
            buttons: [
              {
                  extend: 'copy',
                  exportOptions: {
                      columns: [0, 1, 2]
                  }
              },
              {
                  extend: 'print',
                  exportOptions: {
                      columns: [0, 1, 2]
                  }
              },
              {
                  extend: 'csv',
                  exportOptions: {
                      columns: [0, 1, 2]
                  }
              },
              {
                  extend: 'excel',
                  exportOptions: {
                      columns: [0, 1, 2]
                  }
              },
              {
                  extend: 'pdf',
                  exportOptions: {
                      columns: [0, 1, 2]
                  }
              }
            ]

          });
    });

  $("input#delete-confirm").on("click", function(){
        return confirm("Are you sure to delete this role");
    });

</script>
@endsection
