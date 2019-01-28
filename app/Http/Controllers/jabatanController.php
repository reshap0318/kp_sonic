<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jabatan;

class jabatanController extends Controller
{
    public function index(Request $request)
    {
        try {
          $jabatans = jabatan::all();
          return view('backend.jabatan.index',compact('jabatans'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }

    }

    public function create(Request $request)
    {
        try {
          return view('backend.jabatan.create');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:jabatan,nama',
        ]);
        try {
          $jabatan = new jabatan;
          $jabatan->nama = $request->nama;
          $jabatan->save();
          return redirect()->route('jabatan.index');
         toast()->success('Berhasil Menyimpan Jabatan', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function show($id,Request $request)
    {
        try {
          return redirect()->route('user.index',['jabatan='.$id]);
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        try {
          $jabatan = jabatan::find($id);
          return view('backend.jabatan.edit',compact('jabatan'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'nama' => 'required|min:1|unique:jabatan,nama,'.$id,
        ]);
        try {
          $jabatan = jabatan::find($id);
          $jabatan->nama = $request->nama;
          $jabatan->update();
          toast()->success('Berhasil Mengupdate Jabatan', 'Berhasil');
          return redirect()->route('jabatan.index');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function destroy($id,Request $request)
    {
        try {
          $jabatan = jabatan::find($id);
          $jabatan->delete();
          return redirect()->route('jabatan.index');
          toast()->success('Berhasil Menghapus Jabatan', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }
}
