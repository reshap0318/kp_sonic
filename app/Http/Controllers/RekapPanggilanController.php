<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RekapPanggilan as panggilan;
use App\polres;
use Sentinel;

class RekapPanggilanController extends Controller
{
  public function index()
  {
    try {
      $panggilans = panggilan::all();
      $ada = panggilan::where('polres_id',Sentinel::getuser()->polres_id)->whereday('created_at',now()->day)->first();
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
        $polres = polres::pluck('nama','id');
        return view('backend.panggilan.create',compact('polres'));
      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Mengload Data, Silakan Ulang Login kembali', 'Gagal Load Data');
        return redirect()->back();
      }
  }

  public function store(Request $request)
  {
      $request->validate([
        'nama' => 'required',
        'pangkat' => 'required',
        'nrp' => 'required',
        'panggilan_terjawab' => 'required',
        'panggilan_tidak_terjawab' => 'required'
      ]);

      try {
          $panggilan = new panggilan;
          $panggilan->nama = $request->nama;
          $panggilan->pangkat = $request->pangkat;
          $panggilan->nrp = $request->nrp;
          $panggilan->panggilan_terjawab = $request->panggilan_terjawab;
          $panggilan->panggilan_tidak_terjawab = $request->panggilan_tidak_terjawab;
          $panggilan->polres_id = Sentinel::getuser()->polres_id;
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
        $polres = polres::pluck('nama','id');
        $panggilan = panggilan::find($id);
        return view('backend.panggilan.edit',compact('panggilan','polres'));
    } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Mengload Data, Silakan Ulang Login kembali', 'Gagal Load Data');
        return redirect()->back();
    }
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'pangkat' => 'required',
      'nrp' => 'required',
      'panggilan_terjawab' => 'required',
      'panggilan_tidak_terjawab' => 'required'
    ]);

    try {
      $panggilan = panggilan::find($id);
      $panggilan->nama = $request->nama;
      $panggilan->pangkat = $request->pangkat;
      $panggilan->nrp = $request->nrp;
      $panggilan->panggilan_terjawab = $request->panggilan_terjawab;
      $panggilan->panggilan_tidak_terjawab = $request->panggilan_tidak_terjawab;
      $panggilan->polres_id = Sentinel::getuser()->polres_id;
        toast()->success('Berhasil Update Laporan Panggilan', 'Berhasil');
        $panggilan->update();
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
