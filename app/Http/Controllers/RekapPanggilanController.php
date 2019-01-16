<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RekapPanggilan as panggilan;
use App\polres;
use Sentinel;
use App\operator;

class RekapPanggilanController extends Controller
{
  public function index()
  {
    try {
      $panggilans = panggilan::all();
      if(Sentinel::getuser()->polres_id && Sentinel::getuser()->username!="Admin"){
          $panggilans = panggilan::where('polres_id',Sentinel::getuser()->polres_id)->get();
      }
      return view('backend.panggilan.index',compact('panggilans','ada'));

    } catch (\Exception $e) {
      toast()->error($e, 'Eror');
      toast()->error('Terjadi Eror Saat Meng-load Data, Silakan Ulang Login kembali', 'Gagal Load Data');
      return redirect()->back();
    }
  }


  public function create()
  {
      try {
        $operator = operator::where('polres_id',Sentinel::getuser()->polres_id)->where('aktivasi',1)->pluck('nama','nama');
        if(!Sentinel::getuser()->polres_id){
          $operator = operator::where('aktivasi',1)->pluck('nama','nama');
        }
        $polres = polres::orderby('nama','asc')->pluck('nama','id');
        $aksi = 'create';
        return view('backend.panggilan.create',compact('operator','aksi','polres'));
      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Mengload Data, Silakan Ulang Login kembali', 'Gagal Load Data');
        return redirect()->back();
      }
  }

  public function store(Request $request)
  {
      $request->validate([
        'tanggal' => 'required',
        'piket' => 'required',
        'panggilan_terselesaikan' => 'required',
        'panggilan_prank' => 'required',
        'panggilan_tidak_terjawab' => 'required'
      ]);

      try {

        $ada = panggilan::where('polres_id',Sentinel::getuser()->polres_id)->whereday('tanggal',date("d", strtotime($request->tanggal)))->first();
        if($ada){
          toast()->error('Gagal Menambahkan Data, Data Pada Tanggal'.$request->tanggal.'sudah ada', 'error');
          return redirect()->back();
        }
        $panggilan = new panggilan;
        $panggilan->tanggal = date("Y-m-d", strtotime($request->tanggal));
        $panggilan->piket = $request->piket;
        $panggilan->panggilan_terselesaikan = $request->panggilan_terselesaikan;
        $panggilan->panggilan_prank = $request->panggilan_prank;
        $panggilan->panggilan_tidak_terjawab = $request->panggilan_tidak_terjawab;
        if($request->polres_id){
          $panggilan->polres_id = $request->polres_id;
        }else{
          $panggilan->polres_id = Sentinel::getuser()->polres_id;
        }

        $panggilan->user_id = Sentinel::getuser()->id;
        $panggilan->save();
        toast()->success('Berhasil Menyimpan Laporan', 'Berhasil');
        return redirect()->route('panggilan.index');
      } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Mengload Data', 'Gagal Load Data');
          return redirect()->back();
      }
  }

  public function show($id)
  {
      return redirect()->back();;
  }

  public function edit($id)
  {

    try {
        $operator = operator::where('polres_id',Sentinel::getuser()->polres_id)->where('aktivasi',1)->pluck('nama','nama');
        if(!Sentinel::getuser()->polres_id){
          $operator = operator::where('aktivasi',1)->pluck('nama','nama');
        }
        $polres = polres::orderby('nama','asc')->pluck('nama','id');
        $panggilan = panggilan::find($id);
        $aksi = 'edit';
        return view('backend.panggilan.edit',compact('panggilan','operator','aksi','polres'));
    } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Mengload Data, Silakan Ulang Login kembali', 'Gagal Load Data');
        return redirect()->back();
    }
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'tanggal' => 'required',
      'piket' => 'required',
      'panggilan_terselesaikan' => 'required',
      'panggilan_prank' => 'required',
      'panggilan_tidak_terjawab' => 'required'
    ]);

    try {

        $ada = panggilan::where('polres_id',Sentinel::getuser()->polres_id)->whereday('tanggal',date("Y-m-d", strtotime($request->tanggal)))->first();
        if($ada){
          toast()->error('Gagal Menambahkan Data, Data Pada Tanggal'.$request->tanggal.'sudah ada', 'error');
          return redirect()->back();
        }

        $panggilan = panggilan::find($id);
        $panggilan->tanggal = date("Y-m-d", strtotime($request->tanggal));
        $panggilan->piket = $request->piket;
        $panggilan->panggilan_terselesaikan = $request->panggilan_terselesaikan;
        $panggilan->panggilan_prank = $request->panggilan_prank;
        $panggilan->panggilan_tidak_terjawab = $request->panggilan_tidak_terjawab;
        if($request->polres_id){
          $panggilan->polres_id = $request->polres_id;
        }else{
          $panggilan->polres_id = Sentinel::getuser()->polres_id;
        }

        $panggilan->user_id = Sentinel::getuser()->id;
        $panggilan->update();
        toast()->success('Berhasil Update Laporan Panggilan', 'Berhasil');
        return redirect()->route('panggilan.index');

    } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-upload Data', 'Gagal Load Data');
        return redirect()->back();

    }
  }

  public function destroy($id)
  {
      try {
        $panggilan = panggilan::find($id);
        $panggilan->delete();
        toast()->success('Hapus Data Panggilan', 'Berhasil');
        return redirect()->route('panggilan.index');
      } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-hapus Data', 'Gagal Load Data');
        return redirect()->back();
      }

  }
}
