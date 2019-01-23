@extends('layouts.frontend')

@section('title')
  Detail Panggilan {{$polres->nama}}
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
              <h3>Grafik Laporan Panggilan {{$polres->nama}}<small></small></h3>
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
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">
              <div id="app">
                {!! $chart->container() !!}
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
                        tooltip : {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow',
                                label: {
                                    show: true
                                }
                            }
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                saveAsImage : {show: true},
                                magicType: {show: true, type: ['line', 'bar']},
                            }
                        },
                        calculable : true,
                        legend: {
                            data:['Panggilan Masuk','Panggilan Terselesaikan', 'Panggilan Prank','Panggilan Tidak Terjawab']
                        },
                        xAxis: {
                            type : 'category',
                            data: ['Tidak Terdaftar']
                        },
                        yAxis: {
                          type : 'value'
                        },
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
                    var id = {{$polres->id}};
                    tanggal = tanggal.replace(" - ",",");
                    console.log(server+'/datapolres/'+id+'?data='+tanggal);
                    var x = new Array();
                    var y = new Array();
                    $.ajax({
                      url: server+'/datapolres/'+id+'?data='+tanggal, data: "", dataType: 'json', success: function(rows)
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
                                data: y,
                            },
                      		});

                          datat = rows['pselesai'];
                          for (var i = 0; i < datat.length; i++) {
                            var data = datat[i];
                            document.getElementById("aselesai").innerHTML = data.panggilan_terselesaikan;
                            document.getElementById("pselesai").innerHTML = data.tanggal;
                          }

                          datat = rows['ptotal'];
                          for (var i = 0; i < datat.length; i++) {
                            var data = datat[i];
                            document.getElementById("atotal").innerHTML = data.total;
                            document.getElementById("ptotal").innerHTML = data.tanggal;
                          }

                          datat = rows['ptidak'];
                          for (var i = 0; i < datat.length; i++) {
                            var data = datat[i];
                            document.getElementById("atidak").innerHTML = data.panggilan_tidak_terjawab;
                            document.getElementById("ptidak").innerHTML = data.tanggal;
                          }

                          datat = rows['pprank'];
                          for (var i = 0; i < datat.length; i++) {
                            var data = datat[i];
                            document.getElementById("aprank").innerHTML = data.panggilan_prank;
                            document.getElementById("pprank").innerHTML = data.tanggal;
                          }

                          datai = rows['nilais'];
                          var rataktiv = null;
                          for (var i = 0; i < datai.length; i++) {
                            var ni = datai[i];
                            var warna = "progress-bar-danger";

                              if(parseInt(ni.nilai)>0 && parseInt(ni.nilai)<40){
                                warna = "progress-bar-success";
                              }else if(parseInt(ni.nilai)>=40 && parseInt(ni.nilai)<75){
                                warna = "progress-bar-warning";
                              }

                            if(i==0){
                              rataktiv = '<div>'+
                                '<p>'+ni.hari+'</p>'+
                                '<div>'+
                                  '<div class="progress progress_sm" style="width:76%;">'+
                                    '<div class="progress-bar '+warna+'" runat="server" role="progressbar" data-transitiongoal='+parseInt(ni.nilai)+' style="width: '+parseInt(ni.nilai)+'%;"></div>'+
                                  '</div>'+
                                '</div>'+
                              '</div>'
                            }
                            else{
                                rataktiv = rataktiv +
                                '<div>'+
                                  '<p>'+ni.hari+'</p>'+
                                  '<div>'+
                                    '<div class="progress progress_sm" style="width: 76%;">'+
                                      '<div class="progress-bar '+warna+'" role="progressbar" data-transitiongoal="'+ni.nilai+'" style="width: '+parseInt(ni.nilai)+'%;"></div>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'
                            }
                          }
                          document.getElementById("rataktiv").innerHTML = rataktiv;
                        }
                      });
                  }
                </script>
            </div>
          <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
              <div class="x_title text-center">
                <h2>Rekap Rangkuman Hari</h2>
                <div class="clearfix"></div>
              </div>
              <div id="rataktiv" class="col-md-12 col-sm-12 col-xs-6">
                @foreach($nilais as $nilai)
                  <div>
                    <p>{{$nilai->nama}}</p>
                    <div class="">
                      <div class="progress progress_sm" style="width: 76%;">
                        <div class="progress-bar progress-bar-warning" role="progressbar" data-transitiongoal="{{$nilai->nilai}}"></div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-sign-in"></i></div>
        <div id="atotal" class="count">@if($banyakmax)
            {{$banyakmax[0]->total}}
            @else
              0
            @endif
        </div>
        <h3>Panggilan Masuk Terbanyak</h3>
        <p id="ptotal">@if($banyakmax)
            {{$banyakmax[0]->nama}}
          @else
            Data Tidak Ada
          @endif</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-check-square-o"></i></div>
        <div id="aselesai" class="count">@if($panggilanselesai)
            {{$panggilanselesai[0]->terselesaikan}}
            @else
              0
            @endif</div>
        <h3>Panggilan Terselesaikan Terbanyak</h3>
        <p id="pselesai">@if($panggilanselesai)
            {{$panggilanselesai[0]->nama}}
          @else
            Data Tidak Ada
          @endif</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-question-circle"></i></div>
        <div id="aprank" class="count">@if($panggilanprank)
            {{$panggilanprank[0]->prank}}
          @else
            0
          @endif</div>
        <h3>Panggilan Prank Terbanyak</h3>
        <p id="pprank">@if($panggilanprank)
            {{$panggilanprank[0]->nama}}
          @else
            Data Tidak Ada
          @endif</p>
      </div>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-sign-out"></i></div>
        <div id="atidak" class="count">@if($panggilantidakmax)
            {{$panggilantidakmax[0]->tidak_terjawab}}
          @else
            0
          @endif</div>
        <h3>Panggilan Tidak Terjawab Terbanyak</h3>
        <p id="ptidak">@if($panggilantidakmax)
            {{$panggilantidakmax[0]->nama}}
          @else
            Data Tidak Ada
          @endif</p>
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
