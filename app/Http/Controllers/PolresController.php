<?php

namespace App\Http\Controllers;

use App\polres;
use Illuminate\Http\Request;

class PolresController extends Controller
{
  public function index()
  {
      $polress = polres::all();
      return view('backend.polres.index',compact('polress'));
  }


  public function create()
  {
      return view('backend.polres.create');
  }

  public function store(Request $request)
  {
      $request->validate([
        'nama' => 'required',
        'email' => 'required',
        'alamat' => 'required'
      ]);

      $polres = new polres;
      $polres->nama = $request->nama;
      $polres->alamat = $request->alamat;
      $polres->email = $request->email;
      if($polres->save()){
        return redirect()->route('polres.index');
      }else{

      }
  }

  public function show($id)
  {
      return redirect()->back();;
  }

  public function edit($id)
  {
    $polres = polres::find($id);
    return view('backend.polres.edit',compact('polres'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'nama' => 'required',
      'alamat' => 'required',
      'email' => 'required'
    ]);

    $polres = polres::find($id);
    $polres->nama = $request->nama;
    $polres->email = $request->email;
    $polres->alamat = $request->alamat;
    if($polres->update()){
      return redirect()->route('polres.index');
    }else{

    }
  }

  public function destroy($id)
  {
      $polres = polres::find($id);
      try {
        $polres->delete();
        return redirect()->route('polres.index');
      } catch (\Exception $e) {
        toast()->error($e);
        return redirect()->back();
      }

  }
}
