<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\peminjaman;
use App\barang;
use App\pangkat;
use App\jabatan;
use App\satker;
use App\User;
use Sentinel;

class peminjamanController extends Controller
{
    public function index(Request $request)
    {
        try {
          $peminjamans = peminjaman::whereRAW('id not in (select peminjaman_id from pengembalian)')->get();
          if(!Sentinel::getuser()->inrole(1)){
            $peminjamans = peminjaman::select('peminjaman.*')->join('barang','peminjaman.barang_id','=','barang.id')->where('barang.id_satker',Sentinel::getuser()->satker_id)->get();
          }
          return view('backend.peminjaman.index',compact('peminjamans'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }

    }

    public function create(Request $request)
    {
        try {
          $barang = barang::select('*');
          $user = User::select('*');
          if(!Sentinel::getuser()->inrole(1)){
            $barang = $barang->where('id_satker',Sentinel::getuser()->satker_id);
          }
          $barangs = $barang->where('status',1)->get();
          $barang = $barang->where('status',1)->pluck('no_serial','id');
          $user = $user->pluck('nama','nrp_nip');

          $pangkat = pangkat::pluck('nama','id');
          $jabatan = jabatan::pluck('nama','id');
          $satker = satker::pluck('nama','id');
          if(!Sentinel::getuser()->inrole(1)){
            $satker = satker::where('id',Sentinel::getuser()->satker_id)->pluck('nama','id');
          }
          // dd($barang);
          return view('backend.peminjaman.create',compact('barang','user','barangs','pangkat','jabatan','satker'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
          'tanggal' => 'required|date',
          'barang_id' => 'required',
          'nrp_nip' => 'required',
        ]);
        try {
          $barang = 0;
          $request->barang_id = explode(",",$request->barang_id);
          for ($i=0; $i < count($request->barang_id) ; $i++) {
            $peminjaman = new peminjaman;
            $barang = barang::find($request->barang_id[$i]);
            $peminjaman->tanggal = date('Y-m-d', strtotime($request->tanggal));
            $peminjaman->barang_id = $request->barang_id[$i];
            $peminjaman->nrp_nip = $request->nrp_nip;
            $peminjaman->kondisi = $barang->kondisi;
            $peminjaman->pemberi_id = Sentinel::getuser()->id;
            if($request->keterangan){
              $peminjaman->keterangan = $request->keterangan;
            }

            if($peminjaman->save()){
              $barang->status = 0;
              $barang->update();
            }
          }
         return redirect()->route('serah-terima.index');
         toast()->success('Berhasil Menyimpan Pangkat', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function show($id,Request $request)
    {
        try {
          $peminjaman = peminjaman::find($id);
          return view('backend.peminjaman.show',compact('peminjaman'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        try {
          $peminjaman = peminjaman::find($id);
          $barang = barang::select('*')->whereOr('id',$peminjaman->barang_id);
          $user = User::select('*');
          if(!Sentinel::getuser()->inrole(1)){
            $barang = $barang->where('id_satker',Sentinel::getuser()->satker_id);
          }
          $barangs = $barang->whereOr('status',1)->whereOr('id',$peminjaman->barang_id)->get();
          $barang = $barang->whereOr('status',1)->whereOr('id',$peminjaman->barang_id)->pluck('no_serial','id');
          $user = $user->pluck('nama','nrp_nip');

          $pangkat = pangkat::pluck('nama','id');
          $jabatan = jabatan::pluck('nama','id');
          $satker = satker::pluck('nama','id');
          if(!Sentinel::getuser()->inrole(1)){
            $satker = satker::where('id',Sentinel::getuser()->satker_id)->pluck('nama','id');
          }
          // dd($barang);
          return view('backend.peminjaman.edit',compact('peminjaman','user','barang','barangs','pangkat','jabatan','satker'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'tanggal' => 'required|date',
          'barang_id' => 'required',
          'nrp_nip' => 'required',
        ]);
        try {
          $barang = 0;
          for ($i=0; $i < count($request->barang_id) ; $i++) {
            $peminjaman = peminjaman::find($id);
            $barang = barang::find($request->barang_id[$i]);
            $peminjaman->tanggal = date('Y-m-d', strtotime($request->tanggal));
            $peminjaman->barang_id = $request->barang_id[$i];
            $peminjaman->nrp_nip = $request->nrp_nip;
            $peminjaman->kondisi = $barang->kondisi;
            $peminjaman->pemberi_id = Sentinel::getuser()->id;
            if($request->keterangan){
              $peminjaman->keterangan = $request->keterangan;
            }

            if($peminjaman->save()){
              $barang->status = 0;
              $barang->update();
            }
          }
          toast()->success('Berhasil Mengupdate Pangkat', 'Berhasil');
          return redirect()->route('serah-terima.index');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function destroy($id,Request $request)
    {
        try {
          return redirect()->back();
          toast()->success('Berhasil Menghapus Pangkat', 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }


    public function peminjamnama($id)
    {
      return peminjaman::where('nrp_nip',$id)->get();
    }
}
