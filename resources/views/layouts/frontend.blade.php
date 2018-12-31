<!DOCTYPE html>
<html lang="en">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" href="{{asset('img/unand.png')}}" type="image/ico" />

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('/gantela/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::asset('/gantela/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- NProgress -->
    <link href="{{ URL::asset('/gantela/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ URL::asset('/gantela/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('/gantela/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ URL::asset('/gantela/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ URL::asset('/gantela/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>


    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('/gantela/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{ URL::asset('/gantela/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('/gantela/build/css/custom.min.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link rel="stylesheet" href="{{ URL::asset('/gantela/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/gantela/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}">
    @yield('style')
  </head>

<!-- gunkana nav-sm untuk membuat tampilan di block, dan nav-md gunakan untuk memperbesar -->
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          @include('frontend.sidebar')
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            @include('frontend.topmenu')
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @include('frontend.erorfalid')
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('frontend.footer')
        <!-- /footer content -->
      </div>
    </div>




    <!-- jQuery -->
    <script src="{{ URL::asset('/gantela/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::asset('/gantela/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('/gantela/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('/gantela/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ URL::asset('/gantela/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ URL::asset('/gantela/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ URL::asset('/gantela/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ URL::asset('/gantela/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ URL::asset('/gantela/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ URL::asset('/gantela/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ URL::asset('/gantela/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ URL::asset('/gantela/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ URL::asset('/gantela/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ URL::asset('/gantela/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('/gantela/build/js/custom.min.js ') }}"></script>
    <!-- datatables -->
    <script src="{{ URL::asset('/gantela/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('/gantela/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript">
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    </script>

    @yield('scripts')
  </body>
</html>
