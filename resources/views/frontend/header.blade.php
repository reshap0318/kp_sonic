
  <title>Silab | @yield('title') </title>

  <!-- Bootstrap -->
  <link href="{{ URL::asset('/gantela/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ URL::asset('/gantela/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ URL::asset('/gantela/build/css/custom.min.css') }}" rel="stylesheet">
  <!-- Datatables -->
  <link rel="stylesheet" href="{{ URL::asset('/gantela/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('/gantela/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}">
  @yield('style')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">