<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\merek;
use DB;

class merekController extends Controller
{
    public function index(Request $request)
    {
        try {
          $mereks = merek::select('merek.id','merek.nama',DB::raw('count(barang.id) as total'))
          ->leftjoin('barang','merek.id','barang.id_merek')
          ->groupby('merek.nama','merek.id')->get();
          return view('backend.merek.index',compact('mereks'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }

    }

    public function create(Request $request)
    {
        try {
          return view('backend.merek.create');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:merek,nama',
        ]);
        try {
          $merek = new merek;
          $merek->nama = $request->nama;
          $merek->save();
          return redirect()->route('merek.index');
         toast()->success('Berhasil Menyimpan Kondisi', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function show($id,Request $request)
    {
        try {
          return redirect()->route('barang.index',['merek='.$id]);
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        try {
          $merek = merek::find($id);
          return view('backend.merek.edit',compact('merek'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:merek,nama,'.$id,
        ]);
        try {
          $merek = merek::find($id);
          $merek->nama = $request->nama;
          $merek->update();
          toast()->success('Berhasil Mengupdate Kondisi', 'Berhasil');
          return redirect()->route('merek.index');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function destroy($id,Request $request)
    {
        try {
          $merek = merek::find($id);
          $merek->delete();
          return redirect()->route('merek.index');
          toast()->success('Berhasil Menghapus Kondisi', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }
}
