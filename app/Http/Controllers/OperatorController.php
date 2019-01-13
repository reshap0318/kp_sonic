<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\operator;
use App\polres;
use Sentinel;

class OperatorController extends Controller
{
    public function index(Request $request)
    {

          $operators = new operator;
          $operators->operator = operator::all();
      try {
        if(Sentinel::getuser()->polres_id){
          $operators = polres::find(Sentinel::getuser()->polres_id);
        }
        // dd($operators);
        return view('backend.operator.index',compact('operators'));

      } catch (\Exception $e) {
        toast()->error($e,'eror');
        toast()->error('Gagal Saat Meng-Load Data', 'eror');
        return redirect()->back();
      }

    }

    public function create(Request $request)
    {
      try {
        $polres = polres::pluck('nama','id');
        return view('backend.operator.create',compact('polres'));
      } catch (\Exception $e) {
        toast()->error($e,'eror');
        toast()->error('Gagal Saat Meng-Load Data', 'eror');
        return redirect()->back();
      }
    }

    public function store(Request $request)
    {
      try {
        $operator = new operator;
        $operator->nama = $request->nama;
        $operator->no_sk = $request->no_sk;
        $operator->aktivasi = 1;
        $operator->polres_id = Sentinel::getuser()->polres_id;

        if ($request->hasFile('foto_sk') && $request->foto_sk->isValid()) {
            $path = 'img/foto_sks';
            $oldfile = $operator->foto_sk;

            $fileext = $request->foto_sk->extension();
            $filename = uniqid("foto_sks-").'.'.$fileext;

            //Real File
            $filepath = $request->file('foto_sk')->storeAs($path, $filename, 'local');
            //Avatar File
            $realpath = storage_path('app/'.$filepath);
            $operator->foto_sk = $filename;
        }

        $operator->save();
        toast()->success('Berhasil Menyimpan Data Operator', 'Berhasil');
        return redirect()->route('operator.index');
      } catch (\Exception $e) {
        toast()->error($e,'eror');
        toast()->error('Gagal Saat Meng-Load Data', 'eror');
        return redirect()->back();
      }
    }

    public function edit(Request $request, $id)
    {
      try {

        $operator = operator::find($id);
        $polres = polres::pluck('nama','id');
        return view('backend.operator.edit',compact('polres','operator'));

      } catch (\Exception $e) {
        toast()->error($e,'eror');
        toast()->error('Gagal Saat Meng-Load Data', 'eror');
        return redirect()->back();
      }
    }

    public function update(Request $request, $id)
    {
      try {
        $operator = operator::find($id);
        $operator->nama = $request->nama;
        $operator->no_sk = $request->no_sk;
        $operator->aktivasi = 1;
        $operator->polres_id = Sentinel::getuser()->polres_id;

        if ($request->hasFile('foto_sk') && $request->foto_sk->isValid()) {
            $path = 'img/foto_sks';
            $oldfile = $operator->foto_sk;

            $fileext = $request->foto_sk->extension();
            $filename = uniqid("foto_sks-").'.'.$fileext;

            //Real File
            $filepath = $request->file('foto_sk')->storeAs($path, $filename, 'local');
            //Avatar File
            $realpath = storage_path('app/'.$filepath);
            $operator->foto_sk = $filename;
        }

        $operator->save();
        toast()->success('Berhasil Meng-Update Data Operator', 'Berhasil');
        return redirect()->route('operator.index');

      } catch (\Exception $e) {
        toast()->error($e,'eror');
        toast()->error('Gagal Saat Meng-Load Data', 'eror');
        return redirect()->back();
      }
    }

    public function destroy($id)
    {
      try {

        $operator = operator::find($id);
        $operator->delete();
        toast()->success('Berhasil Meng-Hapus Data Operator', 'Berhasil');
        return redirect()->route('operator.index');

      } catch (\Exception $e) {
        toast()->error($e,'eror');
        toast()->error('Gagal Saat Meng-Load Data', 'eror');
        return redirect()->back();
      }
    }
}
