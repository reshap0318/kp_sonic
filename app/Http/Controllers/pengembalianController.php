<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengembalian;
use App\peminjaman;
use App\User;
use App\barang;
use DB;
use Sentinel;

class pengembalianController extends Controller
{
    public function index(Request $request)
    {
        try {
          $pengembalians = pengembalian::orderby('tanggal','asc')->get();
          if(!Sentinel::getuser()->inrole(1)){
            $pengembalians = pengembalian::select('pengembalian.*')->join('peminjaman','pengembalian.peminjaman_id','=','peminjaman.id')->join('barang','peminjaman.barang_id','=','barang.id')->where('barang.id_satker',Sentinel::getuser()->satker_id)->orderby('tanggal','asc')->get();
          }
          // dd($pengembalians);
          return view('backend.pengembalian.index',compact('pengembalians'));
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }

    }

    public function create(Request $request)
    {
        try {
          $peminjaman = peminjaman::select('peminjaman.*','barang.no_serial')->join('barang','peminjaman.barang_id','=','barang.id')->whereRAW('peminjaman.id not in (select peminjaman_id from pengembalian)');
          $user = User::select('*');
          if(!Sentinel::getuser()->inrole(1)){
            $peminjaman = $peminjaman->where('barang.id_satker',Sentinel::getuser()->satker_id);
          }
          $peminjamans = $peminjaman->get();
          $peminjaman = $peminjaman->pluck('barang.no_serial','peminjaman.id');
          $user = $user->pluck('nama','nrp_nip');
          // dd([$peminjaman,$user,$peminjamans]);
          return view('backend.pengembalian.create',compact('peminjaman','user','peminjamans'));
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
          'peminjaman_id' => 'required',
        ]);
        try {
            $pengembalian = new pengembalian;
            $pengembalian->tanggal = date('Y-m-d', strtotime($request->tanggal));
            $pengembalian->peminjaman_id = $request->peminjaman_id;
            $pengembalian->nrp_nip = Sentinel::getuser()->nrp_nip;
            $pengembalian->kondisi = $request->kondisi;
            if($request->keterangan){
              $pengembalian->keterangan = $request->keterangan;
            }
            if($pengembalian->save()){
              $peminjaman = peminjaman::find($request->peminjaman_id);
              $barang = barang::find($peminjaman->barang_id);
              $barang->kondisi = $request->kondisi;
              $barang->status = 1;
              $barang->update();
            }
         toast()->success('Berhasil Menyimpan Pengembalian Barang', 'Berhasil');
         return redirect()->route('pengembalian.index');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function show($id,Request $request)
    {
        try {
          return redirect()->route('user.index',['pengembalian='.$id]);
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data', 'Gagal');
          return redirect()->back();
        }
    }

    public function edit($id,Request $request)
    {
        try {
          $pengembalian = pengembalian::find($id);
          $peminjaman = peminjaman::select('peminjaman.*','barang.no_serial')->join('barang','peminjaman.barang_id','=','barang.id')->whereRAW('peminjaman.id not in (select peminjaman_id from pengembalian)');
          $user = User::select('*');
          if(!Sentinel::getuser()->inrole(1)){
            $peminjaman = $peminjaman->where('barang.id_satker',Sentinel::getuser()->satker_id);
          }
          $peminjamans = $peminjaman->get();
          $peminjaman = $peminjaman->pluck('barang.no_serial','peminjaman.id');
          $user = $user->pluck('nama','nrp_nip');
          // dd([$peminjaman,$user,$peminjamans,$pengembalian]);
          toast()->success('Berhasil Mengupdate Pengembalian Barang', 'Berhasil');
          return view('backend.pengembalian.edit',compact('pengembalian','user','peminjaman','peminjamans'));
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
          'peminjaman_id' => 'required',
        ]);
        try {
            $pengembalian = pengembalian::find($id);
            $pengembalian->tanggal = date('Y-m-d', strtotime($request->tanggal));
            $pengembalian->peminjaman_id = $request->peminjaman_id;
            $pengembalian->nrp_nip = Sentinel::getuser()->nrp_nip;
            $pengembalian->kondisi = $request->kondisi;
            if($request->keterangan){
              $pengembalian->keterangan = $request->keterangan;
            }
            if($pengembalian->save()){
              $peminjaman = peminjaman::find($request->peminjaman_id);
              $barang = barang::find($peminjaman->barang_id);
              $barang->kondisi = $request->kondisi;
              $barang->status = 1;
              $barang->update();
            }
         toast()->success('Berhasil Menyimpan Pengembalian Barang', 'Berhasil');
         return redirect()->route('pengembalian.index');
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
      return pengembalian::where('nrp_nip',$id)->get();
    }
}
