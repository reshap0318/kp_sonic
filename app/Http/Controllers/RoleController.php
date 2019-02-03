<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Sentinel;
use Route;

class RoleController extends Controller
{

    public function index()
    {
      try {
        $roles = Role::all();
        return view('backend.role.index',compact('roles'));
      } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Mengload Data, Silakan Ulang Login kembali', 'Gagal Load Data');
          return redirect()->back();
      }
    }


    public function create()
    {
      try {
        $roles = Role::get()->pluck('name', 'id');
        return view('backend.role.create');
      } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Mengload Data, Silakan Ulang Login kembali', 'Gagal Load Data');
          return redirect()->back();
      }
    }


    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:roles',
            'name' => 'required',
        ]);
        try {
            $role = new Role;
            $role->slug = $request->slug;
            $role->name = $request->name;
            $role->permissions = ['{"home.dashboard":true}'];
            $role->save();
            toast()->success('Berhasil Meng-Nyimpan Role', 'Berhasil');
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            toast()->error($e, 'Eror');
            toast()->error('Terjadi Eror Saat Meng-Nyimpan Data', 'Gagal Load Data');
            return redirect()->back();
        }
    }


    public function show($id)
    {
        try {
          $users = null;
          if($id){
              $role = Sentinel::findRoleBySlug( $id);
              $users = $role->users()->get();
          }
          return view('backend.user.index',compact('users'));

        } catch (\Exception $e) {
            toast()->error($e, 'Eror');
            toast()->error('Terjadi Eror Saat Mengload Data, Silakan Ulang Login kembali', 'Gagal Load Data');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
          $role = Role::find($id);
          return view('backend.role.edit',compact('role'));
        } catch (\Exception $e) {
            toast()->error($e, 'Eror');
            toast()->error('Terjadi Eror Saat Mengload Data, Silakan Ulang Login kembali', 'Gagal Load Data');
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        try {
          $request->validate([
              'slug' => 'required',
              'name' => 'required',
          ]);
          $role = Role::find($id);
          $role->slug = $request->slug;
          $role->name = $request->name;
          $role->save();
          toast()->success('Berhasil Update Role', 'Berhasil');
          return redirect()->route('role.index');
        } catch (\Exception $e) {
            toast()->error($e, 'Eror');
            toast()->error('Terjadi Eror Saat Mengload Data', 'Gagal Load Data');
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        try {
            $role = Role::find($id);
            $role->delete();
            toast()->success('Hapus Data Role', 'Berhasil');
            return redirect()->route('role.index');
        } catch (\Exception $e) {
            toast()->error($e, 'Eror');
            toast()->error('Terjadi Eror Saat Mengload Data', 'Gagal Load Data');
            return redirect()->back();
        }
    }

    public function permissions($id)
    {
        try {
          $role = Sentinel::findRoleById($id);

          $routes = Route::getRoutes();
          $actions = [];
          foreach ($routes as $route) {
              if ($route->getName() != "" && !substr_count($route->getName(), 'payment')) {
                  $actions[] = $route->getName();
              }
          }

          $var = [];
          $i = 0;
          foreach ($actions as $action) {

              $input = preg_quote(explode('.', $action )[0].".", '~');
              $var[$i] = preg_grep('~' . $input . '~', $actions);
              $actions = array_values(array_diff($actions, $var[$i]));
              $i += 1;
          }
          $actions = array_filter($var);
          // dd([$actions,$var]);
          return View('backEnd.role.permission', compact('role', 'actions'));
        } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Permission, Silakan Ulang Login kembali', 'Gagal Load Data');
          return redirect()->back();
        }
    }

    public function simpan($id, Request $request)
    {
        try {
          // dd($request->all());
          $role = Sentinel::findRoleById($id);
          $role->permissions = [];
          if($request->permissions){
              foreach ($request->permissions as $permission) {
                  if(explode('.', $permission)[1] == 'create'){
                      $role->addPermission($permission);
                      $role->addPermission(explode('.', $permission)[0].".store");
                  }
                  else if(explode('.', $permission)[1] == 'edit'){
                      $role->addPermission($permission);
                      $role->addPermission(explode('.', $permission)[0].".update");
                  }
                  else{
                      $role->addPermission($permission);
                  }
              }
          }
          $role->save();
          toast()->success('Berhasil Menyimpan Role', 'Berhasil');
          return redirect()->route('role.index');
        } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Nyimpan Permission, Silakan Ulang Login kembali', 'Gagal Load Data');
          return redirect()->back();
        }
    }
}
