<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Sentinel;
use App\Charts\Echarts;
use App\rekapPanggilan as panggilan;
use App\polres;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function home($value='')
    {
        return view('welcome');
    }
    public function YourhomePage($value='')
    {
        return view('home');
    }
    public function dashboard(Request $request)
    {

      $panggilanmax = panggilan::select('created_at',DB::raw('max(panggilan_terjawab) as angka'))->orderby('angka','desc')->groupby('created_at')->first();
      $panggilantidakmax = panggilan::select('created_at',DB::raw('max(panggilan_tidak_terjawab) as angka'))->orderby('angka','desc')->groupby('created_at')->first();
      $banyakmax = panggilan::select('created_at',DB::raw('max(panggilan_terjawab + panggilan_tidak_terjawab) as angka'))->orderby('angka','desc')->groupby('created_at')->first();

      if(!$panggilanmax){
          $panggilanmax = 0;
      }else{
          $panggilanmax = $panggilanmax->angka;
      }

      if(!$panggilantidakmax){
          $panggilantidakmax = 0;
      }else{
          $panggilantidakmax = $panggilantidakmax->angka;
      }

      if(!$banyakmax){
        $banyakmax = 0;
      }else {
        $banyakmax = $banyakmax->angka;
      }

      $polress = polres::select('polres.nama','rekap_panggilans.panggilan_terjawab','rekap_panggilans.panggilan_tidak_terjawab')
      ->leftjoin('rekap_panggilans','polres.id','=','rekap_panggilans.polres_id')
      ->whereday('rekap_panggilans.created_at',now()->day)->get();

      if($request->data){
        $data = explode(",",$request->data);
        $polress = polres::select('polres.nama','rekap_panggilans.panggilan_terjawab','rekap_panggilans.panggilan_tidak_terjawab')
        ->leftjoin('rekap_panggilans','polres.id','=','rekap_panggilans.polres_id')
        ->whereraw("DATE_FORMAT(rekap_panggilans.created_at, '%d/%m/%Y') BETWEEN '$data[0]' AND '$data[1]' ")->get();
      }

      $chart = new Echarts;
      $label = [];
      foreach ($polress as $polres) {
        Array_push($label,$polres->nama);
      }

      $chart->labels($label)->load(url('datadash'));
      return view('dashboard', compact('chart','panggilanmax','panggilantidakmax','banyakmax'));
    }

    public function data(Request $request)
    {
        $panggilanmax = panggilan::select(DB::raw('sum(panggilan_terjawab) as angka'))->orderby('angka','desc')->groupby('polres_id')->first();
        $panggilantidakmax = panggilan::select(DB::raw('max(panggilan_tidak_terjawab) as angka'))->orderby('angka','desc')->groupby('created_at')->first();
        $banyakmax = panggilan::select(DB::raw('max(panggilan_terjawab + panggilan_tidak_terjawab) as angka'))->orderby('angka','desc')->groupby('created_at')->first();

        $panggilans = panggilan::select(DB::RAW('polres.nama, sum(rekap_panggilans.panggilan_terjawab) as terjawab, SUM(rekap_panggilans.panggilan_tidak_terjawab) as tidak_terjawab, sum(rekap_panggilans.panggilan_tidak_terjawab+rekap_panggilans.panggilan_terjawab) as total'))
        ->leftjoin('polres','rekap_panggilans.polres_id','=','polres.id')
        ->whereday('rekap_panggilans.created_at',now()->day)
        ->groupby('polres.nama')->get();

        if($request->data){
            $data = explode(",",$request->data);
            $mulai = date('Ymd', strtotime($data[0]));
            $akhir = date('Ymd', strtotime($data[1]));

            $panggilanmax = panggilan::select(DB::raw('sum(panggilan_terjawab) as angka'))->whereRAW("DATE_FORMAT(rekap_panggilans.created_at, '%Y%m%d') BETWEEN '$mulai' AND '$akhir'")->orderby('angka','desc')->groupby('polres_id')->first();
            $panggilantidakmax = panggilan::select(DB::raw('sum(panggilan_tidak_terjawab) as angka'))->whereRAW("DATE_FORMAT(rekap_panggilans.created_at, '%Y%m%d') BETWEEN '$mulai' AND '$akhir'")->orderby('angka','desc')->groupby('created_at')->first();
            $banyakmax = panggilan::select(DB::raw('sum(panggilan_terjawab + panggilan_tidak_terjawab) as angka'))->whereRAW("DATE_FORMAT(rekap_panggilans.created_at, '%Y%m%d') BETWEEN '$mulai' AND '$akhir'")->orderby('angka','desc')->groupby('created_at')->first();


            $panggilans = panggilan::select(DB::RAW('polres.nama, sum(rekap_panggilans.panggilan_terjawab) as terjawab, SUM(rekap_panggilans.panggilan_tidak_terjawab) as tidak_terjawab, sum(rekap_panggilans.panggilan_tidak_terjawab+rekap_panggilans.panggilan_terjawab) as total'))
            ->leftjoin('polres','rekap_panggilans.polres_id','=','polres.id')
            ->whereRAW("DATE_FORMAT(rekap_panggilans.created_at, '%Y%m%d') BETWEEN '$mulai' AND '$akhir'")
            ->groupby('polres.nama')->get();
          }

          $chart = new Echarts;
          $label = [];
          $masuk = [];
          $jawab = [];
          $tjawab = [];
          foreach ($panggilans as $panggilan) {
            Array_push($label,$panggilan->nama);
            Array_push($masuk,$panggilan->total);
            Array_push($jawab,$panggilan->terjawab);
            Array_push($tjawab,$panggilan->tidak_terjawab);
          }

          $chart->labels($label);


          $chart->dataset('Panggilan Masuk', 'bar', $masuk)->color('#006400');
          $chart->dataset('Panggilan Terjawab', 'bar', $jawab)->color('#00008B');
          $chart->dataset('Panggilan Tidak Terjawab', 'bar', $tjawab)->color('#b20000');
          $hasil = [];
          // dd($chart->datasets[0]);
          $dat = [];
          foreach($chart->datasets as $data){
               foreach ($data->options as $key) {
                   $color = $key;
               }
              array_push($dat,array("data"=>$data->values,"name"=>$data->name,"type"=>$data->type,"color"=>$color));
          }

          if(!$panggilanmax){
              $panggilanmax = 0;
          }else{
              $panggilanmax = $panggilanmax->angka;
          }

          if(!$panggilantidakmax){
              $panggilantidakmax = 0;
          }else{
              $panggilantidakmax = $panggilantidakmax->angka;
          }

          if(!$banyakmax){
            $banyakmax = 0;
          }else {
            $banyakmax = $banyakmax->angka;
          }

          $hasil = ['angka'=>$dat,'label'=>$label,'pmax'=>$panggilanmax,'pbanyak'=>$banyakmax,'ptmax'=>$panggilantidakmax];
          return $hasil;
          // return $chart->api();
    }

}
