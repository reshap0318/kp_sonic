<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inventaris;
use App\inventarisDetail as detail;

class InventarisDetailController extends Controller
{
    public function index(Request $request)
    {
        if($request->inventarisId){
          $details = inventaris::find($request->inventarisId);
          return view('backend.inventarisD.index');
        }else{
          return view('frontend.404');
        }
    }
}
