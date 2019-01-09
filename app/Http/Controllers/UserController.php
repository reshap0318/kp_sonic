<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Role;
use App\polres;
use Sentinel;
use Activation;
use Route;

class UserController extends Controller
{

    public function index()
    {
        $users = user::all();
        //dd(Sentinel::getUser()->avatar);
        return view('backend.user.index',compact('users'));
    }


    public function create()
    {
        $action = 'create';
        $role = Role::get()->pluck('name', 'id');
        $polres = polres::orderby('nama','asc')->pluck('nama','id');
        //dd($role);
        return view('backend.user.create',compact('role','action', 'polres'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|min:3|unique:users',
            'kode' => 'required|min:3',
            'polres_id' => 'required',
            'role' => 'required',
            'password' => 'required|same:password_confirm',
            'avatar' => 'image|mimes:jpg,png,jpeg,gif',
        ]);
        $user = new User;
        $user->username = $request->username;
        $user->permissions = ['{"home.dashboard":true}'];
        //dd([$request->role, $user->permissions]);
        $user->kode = $request->kode;
        $user->polres_id = $request->polres_id;
        $user->password = bcrypt($request->password);
        $qrLogin=bcrypt($user->personal_number.$user->polres_id.str_random(40));
        $user->QRpassword= $qrLogin;

        if ($request->hasFile('avatar') && $request->avatar->isValid()) {
            $path = 'img/avatars';
            $oldfile = $user->avatar;

            $fileext = $request->avatar->extension();
            $filename = uniqid("avatars-").'.'.$fileext;

            //Real File
            $filepath = $request->file('avatar')->storeAs($path, $filename, 'local');
            //Avatar File
            $realpath = storage_path('app/'.$filepath);
            $user->avatar = $filename;
        }
//dd([$request->role]);
        if($user->save()){
            $activation = Activation::create($user);
            $activation = Activation::complete($user, $activation->code);
            //role

            $user->roles()->sync([$request->role]);

            return redirect()->route('user.index');
            //aktive

        }else{

        }
    }


    public function show($id)
    {
      $user = user::find($id);
      return view('backend.user.show',compact('user'));
    }


    public function edit($id)
    {
        $action = 'edit';
        $role = Role::get()->pluck('name', 'id');
        $user = User::find($id);
        $polres = polres::pluck('nama','id');
        return view('backend.user.edit',compact('role','user','action','polres'));
    }


    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'username' => 'required',
            'kode' => 'required|min:3',
            'polres_id' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->kode = $request->kode;
        $user->polres_id = $request->polres_id;

        if($user->save()){
            if ($request->role) {
              $user->roles()->sync([$request->role]);
            }
            return redirect()->route('user.index');
        }else{

        }
    }


    public function destroy($id)
    {
        $user = User::find($id);
        if($user->delete()){
            //hapus foto
            $path = 'img/avatars';
            File::delete(storage_path('app'.'/'. $path . '/' . $user->avatar));
            File::delete(public_path($path . '/' . $user->avatar));
            return redirect()->route('user.index');

        }else{

        }
    }

    public function showprofil()
    {
      $user = Sentinel::getuser();
      return view('backend.user.show',compact('user'));
    }

    public function editprofil()
    {
      $user = Sentinel::getuser();
      return view('backend.user.editprofil',compact('user'));
    }

    public function updateprofile($id, Request $request)
    {
      $request->validate([
        'username' => 'required',
        'kode' => 'required',
      ]);

      $user = User::find($id);
      // dd($user);
      $user->username=$request->username;
      $user->kode=$request->kode;
      try {
          $user->save();
          return redirect('profil');
      } catch (\Exception $e) {
        return redirect()->back();
      }

    }

    public function gantiprofil(Request $request,$id)
    {
        $user = User::find($id);
        if ($request->hasFile('avatar') && $request->avatar->isValid()) {
            $path = 'img/avatars';
            $oldfile = $user->avatar;

            $fileext = $request->avatar->extension();
            $filename = uniqid("avatars-").'.'.$fileext;

            //Real File
            $filepath = $request->file('avatar')->storeAs($path, $filename, 'local');
            //Avatar File
            $realpath = storage_path('app/'.$filepath);
            $user->avatar = $filename;
            //hapus foto lama

            try {
              $user->update();
              File::delete(storage_path('app'.'/'. $path . '/' . $oldfile));
              File::delete(public_path($path . '/' . $oldfile));
              return redirect('profil');
            } catch (\Exception $e) {
              return redirect()->back();
            }
        }
    }

    public function showpassword()
    {

    }

    public function gantipassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|same:password_confirm'
        ]);
        $user = User::find($id);
        $user->password = $request->password;
        $user->save();
        return redirect()->back();
    }

    public function permissions($id)
    {
        $user = Sentinel::findById($id);
        $routes = Route::getRoutes();

        $actions = [];
        foreach ($routes as $route) {
            if ($route->getName() != "" && !substr_count($route->getName(), 'payment')) {
                $actions[] = $route->getName();
            }
        }

        //remove store option
        $input = preg_quote("store", '~');
        $var = preg_grep('~' . $input . '~', $actions);
        $actions = array_values(array_diff($actions, $var));

        //remove update option
        $input = preg_quote("update", '~');
        $var = preg_grep('~' . $input . '~', $actions);
        $actions = array_values(array_diff($actions, $var));

        $var = [];
        $i = 0;
        foreach ($actions as $action) {

            $input = preg_quote(explode('.', $action )[0].".", '~');
            $var[$i] = preg_grep('~' . $input . '~', $actions);
            $actions = array_values(array_diff($actions, $var[$i]));
            $i += 1;
        }

        $actions = array_filter($var);
        //dd([$user,$actions]);

        return View('backend.user.permission', compact('user', 'actions'));
    }

    public function simpan(Request $request, $id)
    {
        $user = Sentinel::findById($id);
        $user->permissions = [];
        if($request->permissions){
            foreach ($request->permissions as $permission) {
                if(explode('.', $permission)[1] == 'create'){
                    $user->addPermission($permission);
                    $user->addPermission(explode('.', $permission)[0].".store");
                }
                else if(explode('.', $permission)[1] == 'edit'){
                    $user->addPermission($permission);
                    $user->addPermission(explode('.', $permission)[0].".update");
                }
                else{
                    $user->addPermission($permission);
                }
            }
        }

        $user->save();
        return redirect()->route('user.index');
    }

    public function active($id)
    {
        $user = Sentinel::findById($id);

        $activation = Activation::completed($user);

        if($activation){
            //pemberitahuan kalau sudah aktiv
            return redirect()->route('user.index');
        }
        $activation = Activation::create($user);
        $activation = Activation::complete($user, $activation->code);
        //pemberitahuan kalau sukses

        return redirect()->route('user.index');
    }

    public function deactivate($id)
    {
        $user = Sentinel::findById($id);
        //dd([$id,$user]);
        Activation::remove($user);

        //pemberitahuan user di non aktivkan

        return redirect()->route('user.index');
    }

    public function ajax_all(Request $request){
        if ($request->action=='delete') {
           foreach ($request->all_id as $id) {
             $user = User::findOrFail($id);
             if ($user->deleted_at == null){$user->delete();}
            }
            return response()->json(['success' => true, 'status' => 'Sucesfully Deleted']);
        }
        if ($request->action=='deactivate') {
           foreach ($request->all_id as $id) {
             $user = User::findOrFail($id);
             $activation = Activation::completed($user);
             if ($activation){Activation::remove($user);}
            }
            return response()->json(['success' => true, 'status' => 'Sucesfully deactivate']);
        }
        if ($request->action=='activate') {
           foreach ($request->all_id as $id) {
             $user = User::findOrFail($id);
             $activation = Activation::completed($user);
             if ($activation==''){
                $activation = Activation::create($user);
                $activation = Activation::complete($user, $activation->code);
                }
            }
            return response()->json(['success' => true, 'status' => 'Sucesfully Activated']);
        }
    }
}
