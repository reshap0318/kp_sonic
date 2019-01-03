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
              if( $details->polres_id == Sentinel::getuser()->polres_id || Sentinel::getuser()->id == 1){
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
        if( $id){
          return view('backend.inventarisD.create',compact('id'));
        }else{
          return view('frontend.404');
        }
    }

    public function Store(Request $request)
    {
        $request->validate([
          'kode' => 'required|unique:inventaris_details',
          'kondisi' => 'required',
          'inventaris_id' => 'required',
        ]);

        $detail = new detail;
        $detail->kode = $request->kode;
        $detail->kondisi = $request->kondisi;
        $detail->inventaris_id = $request->inventaris_id;
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
        $detail = detail::find($id);
        $id= $detail->inventaris_id;
        if($id){
          return view('backend.inventarisD.edit',compact('id','detail'));
        }else{
          return view('frontend.404');
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
          'kode' => 'required',
          'kondisi' => 'required',
          'inventaris_id' => 'required'
        ]);

        $detail = detail::find($id);
        $detail->kode = $request->kode;
        $detail->kondisi = $request->kondisi;
        $detail->inventaris_id = $request->inventaris_id;
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
