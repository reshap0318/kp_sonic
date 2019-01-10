<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inventaris;
use App\inventarisDetail as detail;
use Sentinel;

class InventarisDetailController extends Controller
{

    public function index(Request $request)
    {

          try {
            if($request->inventarisId){
              $details = inventaris::find($request->inventarisId);
              // $request->session()->put('jenis', $details->jenis);
              if( $details->polres_id == Sentinel::getuser()->polres_id || Sentinel::inRole('1')){
                return view('backend.inventarisD.index',compact('details'));
              }
            }
            return view('frontend.404');

          } catch (\Exception $e) {
            return redirect()->back();
          }
    }

    public function create(Request $request)
    {
        $id = $request->inventarisId;
        // $jenis = $request->session()->get('jenis');
        try {
          $jenis = inventaris::where('polres_id',Sentinel::getuser()->polres_id)->pluck('jenis','id');
          if($id!='all'){
            $jenis = inventaris::where('id',$id)->where('polres_id',Sentinel::getuser()->polres_id)->pluck('jenis','id');
          }
          return view('backend.inventarisD.create',compact('id','jenis'));
        } catch (\Exception $e) {
          return view('frontend.404');
        }
    }

    public function Store(Request $request)
    {
        $request->validate([
          'kode' => 'required|unique:inventaris_details',
          'kondisi' => 'required',
          'inventaris_id' => 'required',
          'keterangan' => 'required',
        ]);

        $detail = new detail;
        $detail->kode = $request->kode;
        $detail->kondisi = $request->kondisi;
        $detail->inventaris_id = $request->inventaris_id;
        $detail->keterangan = $request->keterangan;
        try {
          $detail->save();
          return redirect()->route('inventaris_detail.index',['inventarisId='.$request->inventaris_id]);
        } catch (\Exception $e) {
          toast()->error($e);
          return redirect()->back();
        }
    }

    public function edit($id)
    {
      try {
          $detail = detail::find($id);
          $id= $detail->inventaris_id;
          if($id){
            $jenis = inventaris::where('id',$id)->where('polres_id',Sentinel::getuser()->polres_id)->pluck('jenis','id');
            return view('backend.inventarisD.edit',compact('id','detail','jenis'));
          }else{
            return view('frontend.404');
          }
      } catch (\Exception $e) {
        return redirect()->back();
      }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'kode' => 'required',
          'kondisi' => 'required',
          'inventaris_id' => 'required',
          'jenis' => 'required',
        ]);

        $detail = detail::find($id);
        $detail->kode = $request->kode;
        $detail->kondisi = $request->kondisi;
        $detail->inventaris_id = $request->inventaris_id;
        $detail->keterangan = $request->keterangan;
        try {
          $detail->update();
          return redirect()->route('inventaris_detail.index',['inventarisId='.$request->inventaris_id]);
        } catch (\Exception $e) {
          toast()->error($e);
          return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $detail = detail::find($id);
        try {
          $detail->delete();
          return redirect()->route('inventaris_detail.index',['inventarisId='.$request->inventaris_id]);
        } catch (\Exception $e) {
          toast()->error($e);
          return redirect()->back();
        }
    }

    public function cek($value='')
    {
        return view('backend.inventarisD.scan');
    }

    public function ceking(Request $request)
    {
        $result =0;
          if ($request->data) {
              $barang = detail::where('kode',$request->data)->first();
              if($barang){
                $result = 1;
              }else{
                $result = 0;
              }
        }
        return $result;
    }


}
