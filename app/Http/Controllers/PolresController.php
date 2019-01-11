<?php

namespace App\Http\Controllers;

use App\polres;
use Illuminate\Http\Request;

class PolresController extends Controller
{
  public function index()
  {
      try {
          $polress = polres::all();
          return view('backend.polres.index',compact('polress'));
      } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data, Silakan Ulang Login kembali', 'Gagal Load Data');
          return redirect()->back();
      }
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

      try {

        $polres = new polres;
        $polres->nama = $request->nama;
        $polres->alamat = $request->alamat;
        $polres->email = $request->email;
        $polres->save();
          toast()->success('Berhasil Me-nyimpan Data Polres', 'Berhasil');
          return redirect()->route('polres.index');

      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-Nyimpan Data', 'Gagal Load Data');
        return redirect()->back();
      }
  }

  public function show($id)
  {
      return redirect()->back();;
  }

  public function edit($id)
  {
    try {
      $polres = polres::find($id);
      return view('backend.polres.edit',compact('polres'));
    } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-Load Data, Silakan Ulang Login kembali', 'Gagal Load Data');
        return redirect()->back();
    }
  }

  public function update(Request $request, $id)
  {

    $request->validate([
      'nama' => 'required',
      'alamat' => 'required',
      'email' => 'required'
    ]);

    try {
      $polres = polres::find($id);
      $polres->nama = $request->nama;
      $polres->email = $request->email;
      $polres->alamat = $request->alamat;
      $polres->update();
      toast()->success('Berhasil Update Data Polres', 'Berhasil');
      return redirect()->route('polres.index');
    } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-update Data', 'Gagal Load Data');
        return redirect()->back();

    }
  }

  public function destroy($id)
  {
      try {
        $polres = polres::find($id);
        $polres->delete();
        toast()->success('Hapus Data Polres', 'Berhasil');
        return redirect()->route('polres.index');
      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-Hapus Data', 'Gagal Load Data');
        return redirect()->back();
      }

  }
}
