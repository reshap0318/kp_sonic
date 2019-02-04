<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Sentinel;
use App\Charts\Echarts;
use App\barang;

class HomeController extends Controller
{
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
      $g1 = barang::select(DB::raw('count(case when kondisi=1 then 1 end) as baik,
      count(case when kondisi=2 then 1 end) as rusak,
      count(case when kondisi=3 then 1 end) as rusakberat,
      count(id) as total'));

      $g2_1 = DB::SELECT(DB::RAW('select barang_jenis.nama, COUNT(peminjaman.id) as total FROM barang_jenis LEFT JOIN barang ON barang_jenis.id = barang.id_jenis LEFT JOIN peminjaman on barang.id = peminjaman.barang_id GROUP BY barang_jenis.nama'));
      $g2_2 = DB::SELECT(DB::RAW('select barang_jenis.nama, COUNT(peminjaman.id) as total FROM barang_jenis LEFT JOIN barang ON barang_jenis.id = barang.id_jenis LEFT JOIN peminjaman on barang.id = peminjaman.barang_id  WHERE barang.id NOT IN (SELECT id from pengembalian) GROUP BY barang_jenis.nama'));
      if(!Sentinel::getuser()->inrole(1)){
        $g1->where('id_satker',Sentinel::getuser()->satker_id);
        $g2_1 = DB::SELECT(DB::RAW('select barang_jenis.nama, COUNT(peminjaman.id) as total FROM barang_jenis LEFT JOIN barang ON barang_jenis.id = barang.id_jenis LEFT JOIN peminjaman on barang.id = peminjaman.barang_id where barang.id_satker = '.Sentinel::getuser()->satker_id.' GROUP BY barang_jenis.nama'));
        $g2_2 = DB::SELECT(DB::RAW('select barang_jenis.nama, COUNT(peminjaman.id) as total FROM barang_jenis LEFT JOIN barang ON barang_jenis.id = barang.id_jenis LEFT JOIN peminjaman on barang.id = peminjaman.barang_id  WHERE barang.id_satker = '.Sentinel::getuser()->satker_id.' && barang.id NOT IN (SELECT id from pengembalian) GROUP BY barang_jenis.nama'));
      }
      // dd($g2_2);
      $nama_g2_1 = [];
      $total_g2_1 = [];
      foreach ($g2_1 as $g2) {
          array_push($nama_g2_1,$g2->nama);
          array_push($total_g2_1,$g2->total);
      }

      $nama_g2_2 = [];
      $total_g2_2 = [];
      foreach ($g2_2 as $g2) {
          array_push($nama_g2_2,$g2->nama);
          array_push($total_g2_2,$g2->total);
      }

      $chart_barang_jenis = new Echarts;
      $chart_barang_jenis->labels($nama_g2_1);
      $chart_barang_jenis->dataset('Total Barang Perjenis', 'pie', $total_g2_1);
      $chart_barang_jenis->options([
          'tooltip' => [
              'trigger' => 'item', // or false, depending on what you want.
              'formatter' => "{a} <br/>{b}: {c} ({d}%)"
          ],
          'legend' => [
              'orient' => 'vertical',
              'x' => 'left',
          ],
          'yAxis' => [
              'show' => false, // or false, depending on what you want.
          ],
          'xAxis' => [
              'show' => false, // or false, depending on what you want.
          ]
      ]);
      $chart_barang_jenis->datasets[0]->options([
        'radius'=>['40%', '55%'],
        'label' => [
          'normal' => [
              'formatter' => "{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}",
              'backgroundColor' => '#eee',
              'borderColor' => '#aaa',
              'borderWidth' => 1,
              'borderRadius' => 4,
              // 'shadowBlur' => 3,
              // 'shadowOffsetX' => 2,
              // 'shadowOffsetY' => 2,
              // 'shadowColor' => '#999',
              // 'padding' => [0, 7],
              'rich' =>  [
                  'a' => [
                      'color' => '#999',
                      'lineHeight' => 22,
                      'align'=> 'center'
                  ],
                  // 'abg' => [
                  //     'backgroundColor' => '#333',
                  //     'width' => '100%',
                  //     'align' => 'right',
                  //     'height' => 22,
                  //     'borderRadius' => [4, 4, 0, 0]
                  // ],
                  'hr' => [
                      'borderColor' => '#aaa',
                      'width' => '100%',
                      'borderWidth' => 0.5,
                      'height' => 0
                  ],
                  'b' => [
                    'fontSize' => 16,
                    'lineHeight' => 33
                  ],
                  'per' => [
                      'color' => '#eee',
                      'backgroundColor' => '#334455',
                      'padding' => [2, 4],
                      'borderRadius' => 2
                  ]
              ]
          ]
        ],
      ]);

      $chart_pinjam_jenis = new Echarts;
      $chart_pinjam_jenis->labels($nama_g2_2);
      $chart_pinjam_jenis->dataset('Peminjaman Yang Belum Kembali', 'pie', $total_g2_2);
      $chart_pinjam_jenis->options([
          'tooltip' => [
              'trigger' => 'item', // or false, depending on what you want.
              'formatter' => "{a} <br/>{b}: {c} ({d}%)"
          ],
          'legend' => [
              'orient' => 'vertical',
              'x' => 'left',
          ],
          'yAxis' => [
              'show' => false, // or false, depending on what you want.
          ],
          'xAxis' => [
              'show' => false, // or false, depending on what you want.
          ]
      ]);
      $chart_pinjam_jenis->datasets[0]->options([
        'radius'=>['40%', '55%'],
        'label' => [
          'normal' => [
              'formatter' => "{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}",
              'backgroundColor' => '#eee',
              'borderColor' => '#aaa',
              'borderWidth' => 1,
              'borderRadius' => 4,
              'shadowBlur' => 3,
              'shadowOffsetX' => 2,
              'shadowOffsetY' => 2,
              'shadowColor' => '#999',
              'padding' => [0, 7],
              'rich' =>  [
                  'a' => [
                      'color' => '#999',
                      'lineHeight' => 22,
                      'align'=> 'center'
                  ],
                  // 'abg' => [
                  //     'backgroundColor' => '#333',
                  //     'width' => '100%',
                  //     'align' => 'right',
                  //     'height' => 22,
                  //     'borderRadius' => [4, 4, 0, 0]
                  // ],
                  'hr' => [
                      'borderColor' => '#aaa',
                      'width' => '100%',
                      'borderWidth' => 0.5,
                      'height' => 0
                  ],
                  'b' => [
                    'fontSize' => 16,
                    'lineHeight' => 33
                  ],
                  'per' => [
                      'color' => '#eee',
                      'backgroundColor' => '#334455',
                      'padding' => [2, 4],
                      'borderRadius' => 2
                  ]
              ]
          ]
        ],
      ]);

      $g1= $g1->first();
      // dd($chart_barang_jenis);
      return view('dashboard',compact('g1','chart_barang_jenis','chart_pinjam_jenis'));
    }

    public function data(Request $request)
    {

    }

}
