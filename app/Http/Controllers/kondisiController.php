<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kondisi;

class kondisiController extends Controller
{
    public function index(Request $request)
    {
        try {
          $kondisis = kondisi::all();
          return view('backend.kondisi.index',compact('kondisis'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }

    }

    public function create(Request $request)
    {
        try {
          return view('backend.kondisi.create');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:kondisi,nama',
        ]);
        try {
          $kondisi = new kondisi;
          $kondisi->nama = $request->nama;
          $kondisi->save();
          return redirect()->route('kondisi.index');
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
          return redirect()->route('user.index',['kondisi='.$id]);
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        try {
          $kondisi = kondisi::find($id);
          return view('backend.kondisi.edit',compact('kondisi'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:kondisi,nama,'.$id,
        ]);
        try {
          $kondisi = kondisi::find($id);
          $kondisi->nama = $request->nama;
          $kondisi->update();
          toast()->success('Berhasil Mengupdate Kondisi', 'Berhasil');
          return redirect()->route('kondisi.index');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function destroy($id,Request $request)
    {
        try {
          $kondisi = kondisi::find($id);
          $kondisi->delete();
          return redirect()->route('kondisi.index');
          toast()->success('Berhasil Menghapus Kondisi', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }
}
