<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jenis;

class jenisController extends Controller
{
    public function index(Request $request)
    {
        try {
          $jeniss = jenis::all();
          return view('backend.jenis.index',compact('jeniss'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
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
          return redirect()->route('user.index',['jenis='.$id]);
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
