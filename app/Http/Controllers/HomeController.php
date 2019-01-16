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

      $panggilanselesai = DB::SELECT(DB::RAW('select polres.nama, sum(rekap_panggilans.panggilan_terselesaikan) as terselesaikan from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id GROUP by polres.nama order by terselesaikan desc limit 1'));
      $panggilanprank = DB::SELECT(DB::RAW('select polres.nama, sum(rekap_panggilans.panggilan_prank) as prank from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id GROUP by polres.nama order by prank desc limit 1'));
      $panggilantidakmax = DB::SELECT(DB::RAW('select polres.nama, sum(rekap_panggilans.panggilan_tidak_terjawab) as tidak_terjawab from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id GROUP by polres.nama order by tidak_terjawab desc limit 1'));
      $banyakmax = DB::SELECT(DB::RAW('select polres.nama, sum(rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_tidak_terjawab+rekap_panggilans.panggilan_terselesaikan) as total from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id GROUP by polres.nama order by total desc limit 1'));
      $nilais = DB::SELECT(DB::RAW("select polres.nama, sum(rekap_panggilans.panggilan_terselesaikan+rekap_panggilans.panggilan_prank)/sum(rekap_panggilans.panggilan_terselesaikan+rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_tidak_terjawab)*100 as nilai from polres join rekap_panggilans on polres.id = rekap_panggilans.polres_id GROUP BY polres.nama ORDER BY nilai desc limit 6"));

      $polress = panggilan::select(DB::RAW('polres.nama, sum(rekap_panggilans.panggilan_terselesaikan) as terjawab, SUM(rekap_panggilans.panggilan_tidak_terjawab) as tidak_terjawab,sum(rekap_panggilans.panggilan_prank) as prank, sum(rekap_panggilans.panggilan_tidak_terjawab+rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_terselesaikan) as total'))
      ->leftjoin('polres','rekap_panggilans.polres_id','=','polres.id')
      ->whereday('rekap_panggilans.tanggal',now()->day)
      ->groupby('polres.nama')->get();

      $chart = new Echarts;
      $label = [];
      foreach ($polress as $polres) {
        Array_push($label,$polres->nama);
      }


      $chart->labels($label)->load(url('datadash'));
      return view('dashboard', compact('chart','panggilanselesai','panggilanprank','panggilantidakmax','banyakmax','nilais'));
    }






    public function data(Request $request)
    {
        $panggilanselesai = DB::SELECT(DB::RAW('select polres.nama, sum(rekap_panggilans.panggilan_terselesaikan) as terselesaikan from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id GROUP by polres.nama order by terselesaikan desc limit 1'));
        $panggilanprank = DB::SELECT(DB::RAW('select polres.nama, sum(rekap_panggilans.panggilan_prank) as prank from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id GROUP by polres.nama order by prank desc limit 1'));
        $panggilantidakmax = DB::SELECT(DB::RAW('select polres.nama, sum(rekap_panggilans.panggilan_tidak_terjawab) as tidak_terjawab from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id GROUP by polres.nama order by tidak_terjawab desc limit 1'));
        $banyakmax = DB::SELECT(DB::RAW('select polres.nama, sum(rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_tidak_terjawab+rekap_panggilans.panggilan_terselesaikan) as total from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id GROUP by polres.nama order by total desc limit 1'));
        $nilais = DB::SELECT(DB::RAW("select polres.nama, sum(rekap_panggilans.panggilan_terselesaikan+rekap_panggilans.panggilan_prank)/sum(rekap_panggilans.panggilan_terselesaikan+rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_tidak_terjawab)*100 as nilai from polres join rekap_panggilans on polres.id = rekap_panggilans.polres_id GROUP BY polres.nama ORDER BY nilai desc limit 6"));

        $panggilans = panggilan::select(DB::RAW('polres.nama, sum(rekap_panggilans.panggilan_terselesaikan) as terjawab, SUM(rekap_panggilans.panggilan_tidak_terjawab) as tidak_terjawab,sum(rekap_panggilans.panggilan_prank) as prank, sum(rekap_panggilans.panggilan_tidak_terjawab+rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_prank) as total'))
        ->leftjoin('polres','rekap_panggilans.polres_id','=','polres.id')
        ->whereday('rekap_panggilans.tanggal',now()->day)
        ->groupby('polres.nama')->get();
        if($request->data){
            $data = explode(",",$request->data);
            $mulai = date('Ymd', strtotime($data[0]));
            $akhir = date('Ymd', strtotime($data[1]));
            $pembagi = DB::SELECT(DB::RAW('select datediff("'.date('Y-m-d', strtotime($data[1])).'","'.date('Y-m-d', strtotime($data[0])).'")+1 as bagi'));
            // dd($pembagi[0]->bagi);
            $panggilanselesai = DB::SELECT(DB::RAW("select polres.nama, sum(rekap_panggilans.panggilan_terselesaikan) as terselesaikan from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id where DATE_FORMAT(rekap_panggilans.tanggal, '%Y%m%d') BETWEEN '$mulai' AND '$akhir' GROUP by polres.nama order by terselesaikan desc limit 1"));
            $panggilanprank = DB::SELECT(DB::RAW("select polres.nama, sum(rekap_panggilans.panggilan_prank) as prank from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id where DATE_FORMAT(rekap_panggilans.tanggal, '%Y%m%d') BETWEEN '$mulai' AND '$akhir' GROUP by polres.nama order by prank desc limit 1"));
            $panggilantidakmax = DB::SELECT(DB::RAW("select polres.nama, sum(rekap_panggilans.panggilan_tidak_terjawab) as tidak_terjawab from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id where DATE_FORMAT(rekap_panggilans.tanggal, '%Y%m%d') BETWEEN '$mulai' AND '$akhir' GROUP by polres.nama order by tidak_terjawab desc limit 1"));
            $banyakmax = DB::SELECT(DB::RAW("select polres.nama, sum(rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_tidak_terjawab+rekap_panggilans.panggilan_terselesaikan) as total from rekap_panggilans JOIN polres on rekap_panggilans.polres_id = polres.id where DATE_FORMAT(rekap_panggilans.tanggal, '%Y%m%d') BETWEEN '$mulai' AND '$akhir' GROUP by polres.nama order by total desc limit 1"));
            $nilais = DB::SELECT(DB::RAW("select polres.nama, sum(rekap_panggilans.panggilan_terselesaikan+rekap_panggilans.panggilan_prank)/sum(rekap_panggilans.panggilan_terselesaikan+rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_tidak_terjawab)*100*count(rekap_panggilans.panggilan_terselesaikan)/".$pembagi[0]->bagi." as nilai from polres join rekap_panggilans on polres.id = rekap_panggilans.polres_id where DATE_FORMAT(rekap_panggilans.tanggal, '%Y%m%d') BETWEEN '$mulai' AND '$akhir' GROUP BY polres.nama ORDER BY nilai desc limit 6"));
            $panggilans = panggilan::select(DB::RAW('polres.nama, sum(rekap_panggilans.panggilan_terselesaikan) as terjawab, SUM(rekap_panggilans.panggilan_tidak_terjawab) as tidak_terjawab,sum(rekap_panggilans.panggilan_prank) as prank, sum(rekap_panggilans.panggilan_tidak_terjawab+rekap_panggilans.panggilan_prank+rekap_panggilans.panggilan_terselesaikan) as total'))
            ->leftjoin('polres','rekap_panggilans.polres_id','=','polres.id')
            ->whereRAW("DATE_FORMAT(rekap_panggilans.tanggal, '%Y%m%d') BETWEEN '$mulai' AND '$akhir'")
            ->groupby('polres.nama')->get();
          }


          // dd([$panggilans]);

          $chart = new Echarts;
          $label = [];
          $masuk = [];
          $jawab = [];
          $tjawab = [];
          $prank = [];
          foreach ($panggilans as $panggilan) {
            Array_push($label,$panggilan->nama);
            Array_push($masuk,$panggilan->total);
            Array_push($jawab,$panggilan->terjawab);
            Array_push($tjawab,$panggilan->tidak_terjawab);
            Array_push($prank,$panggilan->prank);
          }

          $chart->labels($label);


          $chart->dataset('Panggilan Masuk', 'bar', $masuk)->color('#006400');
          $chart->dataset('Panggilan Terselesaikan', 'bar', $jawab)->color('#00008B');
          $chart->dataset('Panggilan Prank', 'bar', $prank)->color('#a54d00');
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
          $hasil = ['angka'=>$dat,'label'=>$label,'pselesai'=>$panggilanselesai,'ptotal'=>$banyakmax,'ptidak'=>$panggilantidakmax,'pprank'=>$panggilanprank,'nilais'=>$nilais];
          return $hasil;
          // return $chart->api();
    }

}
