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

      $polress = polres::select('polres.nama','rekap_panggilans.panggilan_terjawab','rekap_panggilans.panggilan_tidak_terjawab')
      ->leftjoin('rekap_panggilans','polres.id','=','rekap_panggilans.polres_id')
      ->whereday('rekap_panggilans.created_at',now()->day)->get();

      if($request->data){
        $polress = polres::select('polres.nama','rekap_panggilans.panggilan_terjawab','rekap_panggilans.panggilan_tidak_terjawab')
        ->leftjoin('rekap_panggilans','polres.id','=','rekap_panggilans.polres_id')
        ->whereraw('rekap_panggilans.created_at ')->get();
      }


      // dd($polress);

      $chart = new Echarts;
      $label = [];
      $masuk = [];
      $jawab = [];
      $tjawab = [];
      foreach ($polress as $polres) {
        Array_push($label,$polres->nama);
        Array_push($masuk,$polres->panggilan_terjawab + $polres->panggilan_tidak_terjawab);
        Array_push($jawab,$polres->panggilan_terjawab);
        Array_push($tjawab,$polres->panggilan_tidak_terjawab);
      }

      $chart->labels($label);
      // $chart->title('Laporan Telfon Pelayaran Masyarakat');
      // $chart->options([
      //   'title' => [
      //     'textStyle' => [
      //       'fontSize' => 100,
      //       'bold' => true
      //     ]
      //   ]
      // ]);

      $chart->dataset('Panggilan Masuk', 'bar', $masuk)->color('#006400');
      $chart->dataset('Panggilan Terjawab', 'bar', $jawab)->color('#00008B');
      $chart->dataset('Panggilan Tidak Terjawab', 'bar', $tjawab);
      // dd($chart);
      return view('dashboard', compact('chart'));
    }

    public function data(Request $request)
    {
        if(!$request->data){
          $chart = new Echarts;
          $chart->dataset('Sample Test1', 'bar', [3,4,1]);
          $chart->dataset('Sample Test2', 'bar', [1,4,3]);

          return $chart->api();
        }
    }

}
