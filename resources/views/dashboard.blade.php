@extends('layouts.frontend')

@section('title')
  dashboard
@stop

@section('content')
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/gantela/vendors/daterangepick/daterangepicker.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/gantela/vendors/daterangepick/daterangepicker.css') }}" />
<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>Grafik Laporan Panggilan<small></small></h3>
          </div>
          <div class="col-md-6">

            <div class="control-group">
              <div class="controls">
                <div class="input-prepend input-group">
                  <input type="text" onchange="reload()" style="width: 200px" name="waktu" id="reportrange" class="form-control pull-right" value="01/20/2018 - 01/25/2018" />
                  <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
            $(function() {

                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                       'Today': [moment(), moment()],
                       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);

                cb(start, end);

            });
          </script>

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div id="app">
            {!! $chart->container() !!}
            <!-- <div id="{!!$chart->id!!}" style="width:600px; height:400px;"></div> -->

          </div>

          <script src="https://unpkg.com/vue"></script>
          <script>
              var app = new Vue({
                  el: '#app',
              });
          </script>
          <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
          <!-- <script src="{{ URL::asset('/gantela/vendors/jquery/dist/jquery.min.js') }}"></script> -->
          <script>
          id = "{!! $chart->id !!}";
          var myChart = echarts.init(document.getElementById(id));

          // specify chart configuration item and data
            var option = {
                  title: {
                      text: ''
                  },
                  tooltip: {},
                  legend: {
                      data:['Panggilan Masuk','Panggilan Terjawab', 'Panggilan Tidak Terjawab']
                  },
                  xAxis: {
                      data: ['DataBase Tidak Terhubung']
                  },
                  yAxis: {},
                  series: [{
                      name: 'DataBase Tidak Terhubung',
                      type: 'bar',
                      data: [0, 100, 20]
                  }]
              };
            // use configuration item and data specified to show chart
            myChart.setOption(option);


            function reload() {
              var tanggal=document.getElementById("reportrange").value;
              var server="<?php echo Request::root(); ?>";
              tanggal = tanggal.replace(" - ",",");
              console.log(server+'/datadash?data='+tanggal);
              var x = new Array();
              var y = new Array();
              $.ajax({
                url: server+'/datadash?data='+tanggal, data: "", dataType: 'json', success: function(rows)
                  {
                    var datas = rows['angka'];
                    for (var i = 0; i < datas.length; i++) {
                      var data = datas[i];
                      x.push(data);
                    }

                    datax = rows['label'];
                    for (var i = 0; i < datax.length; i++) {
                      var datl = datax[i];
                      y.push(datl);
                    }
                    myChart.setOption({
                			series : x,
                      xAxis: {
                          data: y
                      },
                		});
                  }
                });
            }
          </script>

          <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
        </div>
        <div class="clearfix"></div>
      </div>
    </div>

  </div>
  <br>
  <div class="row">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
        <div class="count">{{$banyakmax->angka}}</div>
        <h3>Telfon</h3>
        <p>Panggilan Terbanyak</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-comments-o"></i></div>
        <div class="count">{{$panggilanmax->angka}}</div>
        <h3>Telfon</h3>
        <p>Panggilan Terjawab Terbanyak</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
        <div class="count">{{$panggilantidakmax->angka}}</div>
        <h3>Telfon</h3>
        <p>Panggilan Tidak Terjawab Terbanyak</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-check-square-o"></i></div>
        <div class="count">179</div>
        <h3>MVP</h3>
        <p>Most Valuable Player</p>
      </div>
    </div>
  </div>
</div>
@stop

@section('scripts')
<script>
  $(document).on('change','#reportrange',function(){

      var data=document.getElementById("reportrange").value;
      // var data=document.getElementById("master").options[document.getElementById("master").selectedIndex].value;
      // $('#kode_master').html("");
      // var coba = data.split('');
      // var s = '';
      // for(var i=0;i<coba.length;i++){
      //   if(i%2!=0 || i>6){
      //     s = s+coba[i];
      //   }else{
      //     s = s+coba[i]+'.';
      //   }
      // }
      // $('#kode_master').append(s);
  });
</script>
@stop
