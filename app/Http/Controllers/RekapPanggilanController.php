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
      $panggilans = panggilan::all();
      if(Sentinel::getuser()->polres_id && Sentinel::getuser()->username!="Admin"){
          $panggilans = panggilan::where('polres_id',Sentinel::getuser()->polres_id)->get();
      }
      return view('backend.panggilan.index',compact('panggilans'));
  }


  public function create()
  {
      $polres = polres::pluck('nama','id');
      return view('backend.panggilan.create',compact('polres'));
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

      $panggilan = new panggilan;
      $panggilan->nama = $request->nama;
      $panggilan->pangkat = $request->pangkat;
      $panggilan->nrp = $request->nrp;
      $panggilan->panggilan_terjawab = $request->panggilan_terjawab;
      $panggilan->panggilan_tidak_terjawab = $request->panggilan_tidak_terjawab;
      $panggilan->polres_id = Sentinel::getuser()->polres_id;
      if($panggilan->save()){
        return redirect()->route('panggilan.index');
      }else{

      }
  }

  public function show($id)
  {
      return redirect()->back();;
  }

  public function edit($id)
  {

    $polres = polres::pluck('nama','id');
    $panggilan = panggilan::find($id);
    return view('backend.panggilan.edit',compact('panggilan','polres'));
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

    $panggilan = panggilan::find($id);
    $panggilan->nama = $request->nama;
    $panggilan->pangkat = $request->pangkat;
    $panggilan->nrp = $request->nrp;
    $panggilan->panggilan_terjawab = $request->panggilan_terjawab;
    $panggilan->panggilan_tidak_terjawab = $request->panggilan_tidak_terjawab;
    $panggilan->polres_id = Sentinel::getuser()->polres_id;
    if($panggilan->update()){
      return redirect()->route('panggilan.index');
    }else{

    }
  }

  public function destroy($id)
  {
      $panggilan = panggilan::find($id);
      try {
        $panggilan->delete();
        return redirect()->route('panggilan.index');
      } catch (\Exception $e) {
        toast()->error($e);
        return redirect()->back();
      }

  }
}
