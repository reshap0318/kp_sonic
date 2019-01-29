<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="{{url('dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>{{ config('app.name', 'Laravel') }}</span></a>
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile clearfix">
    <div class="profile_pic">
      @if(is_null(Sentinel::getUser()->avatar)||Sentinel::getUser()->avatar=="")
        <img src="{{ asset('/img/lea.png') }}" alt="..." class="img-circle profile_img" style="height: 70px;width: 70px">
      @else
        <img src="{{ url('avatar/profile-pict/'.Sentinel::getUser()->avatar) }}" alt="..." class="img-circle profile_img" style="height: 70px;width: 70px">
      @endif

    </div>
    <div class="profile_info">
      <span>Welcome,</span>
      <h2>{{Sentinel::getuser()->nama}}</h2>
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>General</h3>
      <ul class="nav side-menu">
        <li class=""><a href="{{url('dashboard')}}"><i class="fa fa-home"></i>Dashboard</a></li>
        @if (Sentinel::getUser()->hasAnyAccess(['user.index','role.index']))
          <li class=""><a><i class="fa fa-users"></i>Users Management <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display:none;">
              @if (Sentinel::getUser()->hasAccess(['user.index']))
                <li><a href="{{route('user.index')}}">User</a></li>
              @endif
              @if(Sentinel::getUser()->hasAccess(['role.index']))
              <li><a href="{{route('role.index')}}">Role</a></li>
              @endif
            </ul>
          </li>
        @endif
        @if (Sentinel::getUser()->hasAccess(['jabatan.index']))
          <li><a href="{{ route('jabatan.index') }}"><i class="fa fa-university"></i>Jabatan</a></li>
        @endif
        @if (Sentinel::getUser()->hasAccess(['satuan-kerja.index']))
          <li><a href="{{ route('satuan-kerja.index') }}"><i class="fa fa-newspaper-o"></i>Satuan Kerja</a></li>
        @endif
        @if (Sentinel::getUser()->hasAccess(['pangkat.index']))
          <li><a href="{{ route('pangkat.index') }}"><i class="fa fa-thumbs-o-up"></i>Pangkat</a></li>
        @endif
        @if (Sentinel::getUser()->hasAccess(['merek.index']))
          <li><a href="{{ route('merek.index') }}"><i class="fa fa-umbrella"></i>Merek</a></li>
        @endif
        @if (Sentinel::getUser()->hasAccess(['jenis-barang.index']))
          <li><a href="{{ route('jenis-barang.index') }}"><i class="fa fa-cubes"></i>Barang</a></li>
        @endif
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>
  <!-- /menu footer buttons -->
</div>
