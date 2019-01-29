<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang;
use App\merek;
use App\jenis;

class barangController extends Controller
{
    public function index(Request $request)
    {
        try {
          $barangs = barang::all();
          if($request->jenis){
            $jenis = jenis::where('nama',$request->jenis)->first();
            $barangs = barang::where('id_jenis',$jenis->id)->get();
          }else if($request->merek){
            $merek = merek::where('nama',$request->merek)->first();
            $barangs = barang::where('id_merek',$merek->id)->get();
          }
          return view('backend.barang.index',compact('barangs'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }

    }

    public function create(Request $request)
    {
        try {
          $merek = merek::pluck('nama','id');
          $jenis = jenis::pluck('nama','id');
          $type = barang::select('type')->distinct()->pluck('type','type');
          return view('backend.barang.create',compact('merek','jenis','type'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'no_serial' => 'required|min:1|unique:barang,no_serial',
          'th_perolehan' => 'required',
          'id_jenis' => 'required',
          'id_merek' => 'required',
          'type' => 'required',
          'kondisi' => 'required',
          'keterangan' => 'required',
        ]);
        try {
          $barang = new barang;
          $barang->no_serial = $request->no_serial;
          $barang->th_perolehan = $request->th_perolehan;
          $barang->id_jenis = $request->id_jenis;
          $barang->id_merek = $request->id_merek;
          $barang->type = $request->type;
          $barang->kondisi = $request->kondisi;
          $barang->keterangan = $request->keterangan;
          $barang->save();
          return redirect()->route('barang.index');
         toast()->success('Berhasil Menyimpan Barang', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function show($id,Request $request)
    {
        try {
          $barang = barang::find($id);
          return view('backend.barang.show',compact('barang'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        try {
          $barang = barang::find($id);
          $merek = merek::pluck('nama','id');
          $jenis = jenis::pluck('nama','id');
          $type = barang::select('type')->distinct()->pluck('type','type');
          return view('backend.barang.edit',compact('merek','jenis','type','barang'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'no_serial' => 'required|min:1|unique:barang,no_serial,'.$id,
          'th_perolehan' => 'required',
          'id_jenis' => 'required',
          'id_merek' => 'required',
          'type' => 'required',
          'kondisi' => 'required',
          'keterangan' => 'required',
        ]);
        try {
          $barang = barang::find($id);
          $barang->no_serial = $request->no_serial;
          $barang->th_perolehan = $request->th_perolehan;
          $barang->id_jenis = $request->id_jenis;
          $barang->id_merek = $request->id_merek;
          $barang->type = $request->type;
          $barang->kondisi = $request->kondisi;
          $barang->keterangan = $request->keterangan;
          $barang->update();
          toast()->success('Berhasil Mengupdate Barang', 'Berhasil');
          return redirect()->route('barang.index');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function destroy($id,Request $request)
    {
        try {
          $barang = barang::find($id);
          $barang->delete();
          return redirect()->route('barang.index');
          toast()->success('Berhasil Menghapus Barang', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }
}
