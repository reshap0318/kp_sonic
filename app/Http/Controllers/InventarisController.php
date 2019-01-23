<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inventaris;
use Sentinel;
use App\polres;
use DB;

class InventarisController extends Controller
{
  public function index()
  {
      try {
          $inventariss = inventaris::select('inventaris.id','jenis','polres_id',
          DB::raw('count(case when inventaris_details.kondisi=1 then 1 end) as baik,
          count(case when inventaris_details.kondisi=2 then 1 end) as rusak,
          count(case when inventaris_details.kondisi=3 then 1 end) as rusakberat,
          count(case when inventaris_details.kondisi=4 then 1 end) as dihapuskan'))
          ->leftjoin('inventaris_details','inventaris.id','=','inventaris_details.inventaris_id')
          ->groupby('inventaris.id','jenis','polres_id')
          ->distinct()
          ->get();

          if(Sentinel::getuser()->polres_id && !Sentinel::inRole('2')){
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
      } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-load Data, Silakan Ulang Login kembali', 'Gagal Load Data');
          return redirect()->back();
      }
  }


  public function create()
  {
      $kategori = inventaris::select('jenis')->distinct()->pluck('jenis','jenis');
      $polres = polres::orderby('nama','asc')->pluck('nama','id');
      return view('backend.inventaris.create',compact('polres','kategori'));
  }

  public function store(Request $request)
  {
      $request->validate([
        'jenis' => 'required',
      ]);

      try {
          $inventaris = new inventaris;
          $inventaris->jenis = $request->jenis;
          if($request->polres_id){
            $inventaris->polres_id = $request->polres_id;
          }else{
            $inventaris->polres_id = Sentinel::getuser()->polres_id;
          }

          $inventaris->save();
          toast()->success('Berhasil Me-nyimpan Inventaris', 'Berhasil');
          return redirect()->route('inventaris.index');

      } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Nyimpan Data', 'Gagal Load Data');
          return redirect()->back();
      }
  }

  public function show($id)
  {
      return redirect()->route('inventaris_detail.index',['inventarisId='.$id]);
  }

  public function edit($id)
  {
      try {
        $inventaris = inventaris::find($id);
        $polres = polres::orderby('nama','asc')->pluck('nama','id');
        return view('backend.inventaris.edit',compact('inventaris','polres'));
      } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-load Data, Silakan Ulang Login kembali', 'Gagal Load Data');
          return redirect()->back();
      }
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'jenis' => 'required',
    ]);

      try {
        $inventaris = inventaris::find($id);
        $inventaris->jenis = $request->jenis;

        if($request->polres_id){
          $inventaris->polres_id = $request->polres_id;
        }else{
          $inventaris->polres_id = Sentinel::getuser()->polres_id;
        }

        $inventaris->update();
        toast()->success('Berhasil Update Inventaris', 'Berhasil');
        return redirect()->route('inventaris.index');

      }
      catch (\Exception $e) {
        toast()->error($e);
        toast()->error('Gagal Meng-Update Data', 'Gagal');
        return redirect()->back();
      }
  }

  public function destroy($id)
  {
      try {
        $inventaris = inventaris::find($id);
        $inventaris->delete();
        toast()->success('Berhasil Hapus Data Inventaris', 'Berhasil');
        return redirect()->route('inventaris.index');
      } catch (\Exception $e) {
        toast()->error($e);
        toast()->error('Gagal Meng-hapus Data', 'Gagal');
        return redirect()->back();
      }

  }
}
