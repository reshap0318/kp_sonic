<nav>
  <div class="nav toggle">
    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
  </div>

  <ul class="nav navbar-nav navbar-right">
    <li class="">
      <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      @if(is_null(Sentinel::getUser()->avatar)||Sentinel::getUser()->avatar=="")
        <img src="{{ asset('/img/lea.png') }}" alt="...">
      @else
        <img src="{{ url('avatar/profile-pict/'.Sentinel::getUser()->avatar) }}" alt="..." >
      @endif
      {{Sentinel::getUser()->nama}}
        <span class=" fa fa-angle-down"></span>
      </a>
      <ul class="dropdown-menu dropdown-usermenu pull-right">
        <li><a href="{{url('profil')}}"> Profile</a></li>
        <li><a href="{{url('edit-password')}}">Ganti Password</a></li>
        <li><a href="javascript:;">Help</a></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
      </ul>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </li>
  </ul>
</nav>
