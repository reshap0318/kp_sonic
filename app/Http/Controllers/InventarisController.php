<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inventaris;
use Sentinel;
use DB;

class InventarisController extends Controller
{
  public function index()
  {
      $inventariss = inventaris::select('inventaris.id','jenis','polres_id',
      DB::raw('count(case when inventaris_details.kondisi=1 then 1 end) as baik,
      count(case when inventaris_details.kondisi=2 then 1 end) as rusak,
      count(case when inventaris_details.kondisi=3 then 1 end) as rusakberat'))
      ->leftjoin('inventaris_details','inventaris.id','=','inventaris_details.inventaris_id')
      ->groupby('inventaris.id','jenis','polres_id')
      ->distinct()
      ->get();

      if(Sentinel::getuser()->polres_id && Sentinel::getuser()->username!="Admin"){
        $inventariss = inventaris::select('inventaris.id','jenis','polres_id',
        DB::raw('count(case when inventaris_details.kondisi=1 then 1 end) as baik,
        count(case when inventaris_details.kondisi=2 then 1 end) as rusak,
        count(case when inventaris_details.kondisi=3 then 1 end) as rusakberat'))
        ->leftjoin('inventaris_details','inventaris.id','=','inventaris_details.inventaris_id')
        ->groupby('inventaris.id','jenis','polres_id')
        ->distinct()
        ->where('polres_id',Sentinel::getuser()->polres_id)->get();
      }
      if(!$inventariss){
        return redirect()->back();
      }
      return view('backend.inventaris.index',compact('inventariss'));
  }


  public function create()
  {
      return view('backend.inventaris.create');
  }

  public function store(Request $request)
  {
      $request->validate([
        'jenis' => 'required',

      ]);

      $inventaris = new inventaris;
      $inventaris->jenis = $request->jenis;

      if(Sentinel::getuser()->polres_id){
        $inventaris->polres_id = Sentinel::getuser()->polres_id;
      }

      if($inventaris->save()){
        return redirect()->route('inventaris.index');
      }else{

      }
  }

  public function show($id)
  {
      return redirect()->route('inventaris_detail.index',['inventarisId='.$id]);
  }

  public function edit($id)
  {
    $inventaris = inventaris::find($id);
    return view('backend.inventaris.edit',compact('inventaris'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'jenis' => 'required',
    ]);

    $inventaris = inventaris::find($id);
    $inventaris->jenis = $request->jenis;

    if(Sentinel::getuser()->polres_id){
      $inventaris->polres_id = Sentinel::getuser()->polres_id;
    }

    if($inventaris->update()){
      return redirect()->route('inventaris.index');
    }else{

    }
  }

  public function destroy($id)
  {
      $inventaris = inventaris::find($id);
      try {
        $inventaris->delete();
        return redirect()->route('inventaris.index');
      } catch (\Exception $e) {
        toast()->error($e);
        return redirect()->back();
      }

  }
}
