@extends('layouts.frontend')
@section('title')
  Profil {{$user->first_name}}
@stop

@section('content')


<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Profile {{$user->first_name}} {{$user->last_name}}</h3>
    </div>
  </div>
  
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
              <div id="crop-avatar">
                <!-- Current avatar -->
                @if(is_null($user->avatar)||$user->avatar=="")
                  <img style="height: 270px;width: 190px" class="img-responsive avatar-view" src="{{ asset('/img/lea.png') }}" alt="Avatar" title="Change the avatar">
                @else
                  <img style="height: 220px;width: 190px" class="img-responsive avatar-view" src="{{ url('avatar/profile-pict/'.$user->avatar) }}" alt="Avatar" title="Change the avatar">
                @endif
                
              </div>
            </div>
            <h3>{{$user->first_name}} {{$user->last_name}}</h3>

            <ul class="list-unstyled user_data">
              <li><i class="fa fa-map-marker user-profile-icon"></i> LEA SI UNAND
              </li>

              <li>
                <i class="fa fa-briefcase user-profile-icon"></i> 
                  {{$user->roles()->first()->name}}
              </li>
              <li><i class="fa fa-graduation-cap user-profile-icon"></i> 
                @if($user->no_anggota)
                  {{$user->no_anggota}}
                @else
                  <font color="red">Belum Memiliki No Anggota</font> 
                @endif 
              </li>
            </ul>

            <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
            <br />

            <!-- start skills -->
            <h4>Skills</h4>
            <ul class="list-unstyled user_data">
              <li>
                <p>Web Applications</p>
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                </div>
              </li>
              <li>
                <p>Website Design</p>
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                </div>
              </li>
              <li>
                <p>Automation & Testing</p>
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                </div>
              </li>
              <li>
                <p>UI / UX</p>
                <div class="progress progress_sm">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                </div>
              </li>
            </ul>
            <!-- end of skills -->

          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">

            {{-- <div class="profile_title">
              <div class="col-md-6">
                <h2>User Activity Report</h2>
              </div>
              <div class="col-md-6">
                <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                </div>
              </div>
            </div> --}}
            <!-- start of user-activity-graph -->
            {{-- <div id="graph_bar" style="width:100%; height:280px;"></div> --}}
            <!-- end of user-activity-graph -->

            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Piket</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Postingan</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Jadwal Kuliah</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="piket-tab">
                    <!-- start accordion -->
                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Jadwal Piket</h4>
                        </a>
                        <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50px">#</th>
                                  <th class="">Hari</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=0?>
                                @foreach($piket as $pikets)
                                  <tr>
                                    <th class="text-center" scope="row">{{++$no}}</th>
                                    <td>
                                      @if($pikets->hari=='1')
                                        Senin
                                      @elseif($pikets->hari=='2')
                                        Selasa
                                      @elseif($pikets->hari=='3')
                                        Rabu
                                      @elseif($pikets->hari=='4')
                                        Kamis
                                      @elseif($pikets->hari=='5')
                                        Jumat
                                      @else
                                        Bukan Hari Piket
                                      @endif
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Piket Detail</h4>
                        </a>
                        <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50px">#</th>
                                  <th class="">Tanggal</th>
                                  <th class="">Mulai</th>
                                  <th class="">Berakhir</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=0?>
                                @foreach($piket_detail as $piket_details)
                                  <tr>
                                    <th class="text-center" scope="row">{{++$no}}</th>
                                    <td class=" ">{{\Carbon\Carbon::parse($piket_details->tanggal)->format('d F Y')}}</td>
                                    <td>{{ $piket_details->mulai }}</td>
                                    <td>{{ $piket_details->akhir }}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Denda</h4>
                        </a>
                        <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50px">#</th>
                                  <th class="">Jenis Denda</th>
                                  <th class="">Harga</th>
                                  <th class="">Keterangan</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=0;
                                  function rupiah($angka){
                                      $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                                      return $hasil_rupiah;
                                  }
                                ?>
                                @foreach($denda as $dendas)
                                  <tr>
                                    <td class="text-center" scope="row">{{++$no}}</td>
                                    <td class=" ">{{$dendas->jenisdenda->nama}}</td> 
                                    <td class=" ">{{rupiah($dendas->jenisdenda->harga)}}</td>
                                  @if($dendas->status==1)
                                    <td class=" ">Lunas</td>
                                  @else
                                    <td class=" ">Belum Lunas</td>
                                  @endif
                                    <td>
                                      @if (Sentinel::getUser()->hasAccess(['denda.show']))
                                        <a href="{{route('denda.show', $dendas->id)}}" class="btn btn-success btn-xs">Detail Denda</a>
                                      @endif
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingfourx1" data-toggle="collapse" data-parent="#accordion1" href="#collapsefourx1" aria-expanded="false" aria-controls="collapsefourx">
                          <h4 class="panel-title">Izin Piket</h4>
                        </a>
                        <div id="collapsefourx1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfourx">
                          <div class="panel-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50px">#</th>
                                  <th class="">Tanggal</th>
                                  <th class="">Tenggang</th>
                                  <th class="">Alasan</th>
                                  <th class="">Dibuat</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=0;
                                ?>
                                @foreach($izin_piket as $izin)
                                  <tr>
                                    <td class="text-center" scope="row">{{++$no}}</td>
                                    <td class=" ">{{\Carbon\Carbon::parse($izin->tanggal)->format('d F Y')}}</td>
                                    <td class=" ">{{$izin->tenggang}}</td>
                                    <td class=" ">{{$izin->alasan}}</td>
                                    <td class=" ">{{\Carbon\Carbon::parse($izin->created_at)->format('d F Y')}}</td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingfive1" data-toggle="collapse" data-parent="#accordion1" href="#collapsefive1" aria-expanded="false" aria-controls="collapsefive">
                          <h4 class="panel-title">Acc Denda</h4>
                        </a>
                        <div id="collapsefive1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                          <div class="panel-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50px">#</th>
                                  <th class="">Tanggal</th>
                                  <th class="">User</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=0;
                                ?>
                                @foreach($asistenacc as $acc)
                                  <tr>
                                    <td class="text-center" scope="row">{{++$no}}</td>
                                    <td class=" ">{{\Carbon\Carbon::parse($acc->updated_at)->format('d F Y')}}</td>
                                    <td class=" ">{{$acc->user->first_name.' '.$acc->user->last_name}}</td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="postingan-tab">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingsix1" data-toggle="collapse" data-parent="#accordion2" href="#collapsesix1" aria-expanded="true" aria-controls="collapsesix">
                          <h4 class="panel-title">Jadwal Postingan</h4>
                        </a>
                        <div id="collapsesix1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingsix">
                          <div class="panel-body">
                            
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50px">#</th>
                                  <th class="">Tanggal</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=0?>
                                @foreach($postingan as $postingans)
                                  <tr>
                                    <td class="text-center" scope="row">{{++$no}}</td>
                                    <td>{{\Carbon\Carbon::parse($postingans->tanggal)->format('d F Y')}}</td>
                                    <td>
                                      @if(!$postingans->bukti)
                                        @if (Sentinel::getUser()->hasAccess(['postingan.jadwalpost']))
                                          <a href="{{route('postingan.jadwalpost', $postingans->id)}}" class="btn btn-info btn-xs">postingan</a>
                                        @endif
                                      @else
                                        
                                      @endif
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingseven1" data-toggle="collapse" data-parent="#accordion2" href="#collapseseven1" aria-expanded="false" aria-controls="collapseseven">
                          <h4 class="panel-title">Postingan Detail</h4>
                        </a>
                        <div id="collapseseven1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingseven">
                          <div class="panel-body">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th class="text-center" width="50px">#</th>
                                  <th>Tanggal Upload</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no=0?>
                                @foreach($postingan as $postingans)
                                  <tr>
                                    <td class="text-center" scope="row">{{++$no}}</td>
                                    <td>{{\Carbon\Carbon::parse($postingans->tanggal)->format('d F Y')}}</td>
                                    <td>
                                      <td class=" "><a href="{{$postingans->link}}">{{$postingans->judul}}</a></td>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end of accordion -->
                  
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="jadwalkuliah-tab">
                  <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                    photo booth letterpress, commodo enim craft beer mlkshk </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>                   

@stop

