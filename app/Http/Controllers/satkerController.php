<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\satker;

class satkerController extends Controller
{
    public function index(Request $request)
    {
        try {
          $satkers = satker::all();
          return view('backend.satker.index',compact('satkers'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }

    }

    public function create(Request $request)
    {
        try {
          return view('backend.satker.create');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:satker,nama',
        ]);
        try {
          $satker = new satker;
          $satker->nama = $request->nama;
          $satker->save();
          return redirect()->route('satuan-kerja.index');
         toast()->success('Berhasil Menyimpan Satuan Kerja', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function show($id,Request $request)
    {
        try {
          return redirect()->route('user.index',['satker='.$id]);
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        try {
          $satker = satker::find($id);
          return view('backend.satker.edit',compact('satker'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:satker,nama,'.$id,
        ]);
        try {
          $satker = satker::find($id);
          $satker->nama = $request->nama;
          $satker->update();
          toast()->success('Berhasil Mengupdate Satuan Kerja', 'Berhasil');
          return redirect()->route('satuan-kerja.index');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function destroy($id,Request $request)
    {
        try {
          $satker = satker::find($id);
          $satker->delete();
          return redirect()->route('satuan-kerja.index');
          toast()->success('Berhasil Menghapus Satuan Kerja', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }
}
