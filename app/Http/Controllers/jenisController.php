<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jenis;
use App\barang;
use App\merek;
use DB;
use Sentinel;

class jenisController extends Controller
{
    public function index(Request $request)
    {
        try {
          $barangs = barang::select('barang_jenis.id','barang_jenis.nama','satker.nama as satker','satker.id as satker_id',
          DB::raw('count(case when barang.kondisi=1 then 1 end) as baik,
          count(case when barang.kondisi=2 then 1 end) as rusak,
          count(case when barang.kondisi=3 then 1 end) as rusakberat,
          count(case when barang.kondisi=4 then 1 end) as dihapuskan'))
          ->leftjoin('barang_jenis','barang.id_jenis','=','barang_jenis.id')
          ->leftjoin('satker','barang.id_satker','=','satker.id');

          $mereks = merek::select('merek.id','merek.nama',DB::raw('count(barang.id_jenis) as total'))
          ->leftjoin('barang','merek.id','barang.id_merek');

          $jeniss = jenis::select('barang_jenis.id','barang_jenis.nama',DB::raw('count(barang.id_merek) as total'))
          ->leftjoin('barang','barang_jenis.id','barang.id_jenis');


          if(!Sentinel::getUser()->inrole(1)){
            $barangs = $barangs->where('barang.id_satker',Sentinel::getuser()->satker_id);
            $mereks = merek::select('merek.id','merek.nama',DB::raw('count(case when barang.id_satker='.Sentinel::getuser()->satker_id.' then 1 end) as total'))
            ->leftjoin('barang','merek.id','barang.id_merek');
            $jeniss = jenis::select('barang_jenis.id','barang_jenis.nama',DB::raw('count(case when barang.id_satker='.Sentinel::getuser()->satker_id.' then 1 end) as total'))
            ->leftjoin('barang','barang_jenis.id','barang.id_jenis');
          }

          $jeniss = $jeniss->groupby('barang_jenis.nama','barang_jenis.id')->get();
          $mereks = $mereks->groupby('merek.nama','merek.id')->get();
          $barangs = $barangs->groupby('barang_jenis.id','barang_jenis.nama','satker.nama','satker_id')->distinct()->get();
          return view('backend.jenis.index',compact('barangs','mereks','jeniss'));
        } catch (\Exception $e) {
          // dd($e);
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          toast()->error($e->getMessage(), 'Eror');
          return redirect()->back();
        }

    }

    public function create(Request $request)
    {
        try {
          return view('backend.jenis.create');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:barang_jenis,nama',
        ]);
        try {
          $jenis = new jenis;
          $jenis->nama = $request->nama;
          $jenis->save();
          return redirect()->route('jenis-barang.index');
         toast()->success('Berhasil Menyimpan Jenis Barang', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function show($id,Request $request)
    {
        try {
          // dd([$request->id,$id]);
          if(!$request->id || !Sentinel::getUser()->inrole(1)){
            return redirect()->route('barang.index',['jenis='.$id]);
          }else{
            return redirect()->route('barang.index',['jenis='.$id,'satker_id='.$request->id]);
          }
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        try {
          $jenis = jenis::find($id);
          return view('backend.jenis.edit',compact('jenis'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:barang_jenis,nama,'.$id,
        ]);
        try {
          $jenis = jenis::find($id);
          $jenis->nama = $request->nama;
          $jenis->update();
          toast()->success('Berhasil Mengupdate Jenis Barang', 'Berhasil');
          return redirect()->route('jenis-barang.index');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function destroy($id,Request $request)
    {
        try {
          $jenis = jenis::find($id);
          $jenis->delete();
          return redirect()->route('jenis-barang.index');
          toast()->success('Berhasil Menghapus Jenis Barang', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }
}
