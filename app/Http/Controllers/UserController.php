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
      try {
        $users = user::all();
        return view('backend.user.index',compact('users'));
      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-Nyimpan Permission, Silakan Ulang Login kembali', 'Gagal');
        return redirect()->back();
      }
    }


    public function create()
    {
        try {
          $action = 'create';
          $role = Role::get()->pluck('name', 'id');
          $polres = polres::orderby('nama','asc')->pluck('nama','id');
          //dd($role);
          return view('backend.user.create',compact('role','action', 'polres'));
        } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Nyimpan Permission, Silakan Ulang Login kembali', 'Gagal');
          return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|min:3|unique:users',
            'nama' => 'required|min:3',
            'polres_id' => 'required',
            'role' => 'required',
            'password' => 'required|same:password_confirm',
            'avatar' => 'image|mimes:jpg,png,jpeg,gif',
        ]);
        try {
          $user = new User;
          $user->username = $request->username;
          $user->password = bcrypt($request->password);
          $qrLogin=bcrypt($user->personal_number.$user->polres_id.str_random(40));
          $user->nama = $request->nama;

          if($request->telpon){
            $user->telpon = $request->telpon;
          }

          if($request->alamat){
            $user->alamat = $request->alamat;
          }


          $user->polres_id = $request->polres_id;
          if($request->role==1){
            $user->polres_id = null;
          }else{
            $user->polres_id = $request->polres_id;
          }
          $user->permissions = ['{"home.dashboard":true}'];
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
          if($user->save()){
             toast()->success('Berhasil Menyimpan Data User', 'Berhasil');
              $activation = Activation::create($user);
              $activation = Activation::complete($user, $activation->code);
              //role

              $user->roles()->sync([$request->role]);
              if ($request->hasFile('avatar') && $request->avatar->isValid()) {
                    if ($filename != $oldfile) { //kalau file yang lama dan yang baru namanya tidak sama, maka akan melakukan
                        File::delete(storage_path('app'.'/'. $path . '/' . $oldfile));
                        File::delete(public_path($path . '/' . $oldfile));
                      }
                  }

              return redirect()->route('user.index');
              //aktive

          }
        } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Nyimpan Data', 'Gagal');
          return redirect()->back();
        }
    }


    public function show($id)
    {
      try {
        $user = user::find($id);
        return view('backend.user.show',compact('user'));
      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-Load Data, Silakan Ulang Login kembali', 'Gagal');
        return redirect()->back();
      }
    }


    public function edit($id)
    {
        try {
          $action = 'edit';
          $role = Role::get()->pluck('name', 'id');
          $user = User::find($id);
          $polres = polres::pluck('nama','id');
          return view('backend.user.edit',compact('role','user','action','polres'));
        } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Load Data, Silakan Ulang Login kembali', 'Gagal');
          return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'username' => 'required',
            'nama' => 'required|min:3',
            'polres_id' => 'required',
            'role' => 'required',
            'avatar' => 'image|mimes:jpg,png,jpeg,gif',
        ]);

        try {
          $user = User::find($id);
          $user->username = $request->username;
          $user->nama = $request->nama;

          if($request->telpon){
            $user->telpon = $request->telpon;
          }

          if($request->alamat){
            $user->alamat = $request->alamat;
          }

          if($request->role==1){
            $user->polres_id = null;
          }else{
            $user->polres_id = $request->polres_id;
          }


          if($request->password){
            $user->password = bcrypt($request->password);
          }

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

          if($user->save()){
              if ($request->role) {
                $user->roles()->sync([$request->role]);
              }
              if ($request->hasFile('avatar') && $request->avatar->isValid()) {
                    if ($filename != $oldfile) { //kalau file yang lama dan yang baru namanya tidak sama, maka akan melakukan
                        File::delete(storage_path('app'.'/'. $path . '/' . $oldfile));
                        File::delete(public_path($path . '/' . $oldfile));
                      }
                  }

              toast()->success('Berhasil Update Data User', 'Berhasil');
              return redirect()->route('user.index');
          }
        } catch (\Exception $e) {
          toast()->error($e, 'Eror');
          toast()->error('Terjadi Eror Saat Meng-Update User, Silakan Ulang Login kembali', 'Gagal');
          return redirect()->back();
        }
    }


    public function destroy($id)
    {
      try {
        $user = User::find($id);
        $user->delete();
        toast()->success('Berhasil Hapus Foto', 'Berhasil');
        $path = 'img/avatars';
        File::delete(storage_path('app'.'/'. $path . '/' . $user->avatar));
        File::delete(public_path($path . '/' . $user->avatar));
        return redirect()->route('user.index');
      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-Load Data, Silakan Ulang Login kembali', 'Gagal');
        return redirect()->back();
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
        'nama' => 'required',
        'telpon' => 'required',
        'alamat' => 'required',
      ]);

      try {
          $user = User::find($id);
          // dd($user);
          $user->username=$request->username;
          $user->nama=$request->nama;
          $user->telpon = $request->telpon;
          $user->alamat = $request->alamat;
          $user->save();
          toast()->success('Berhasil Update Profile', 'Berhasil');
          return redirect('profil');
      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-Update Profil', 'Gagal');
        return redirect()->back();
      }

    }

    public function gantiprofil(Request $request,$id)
    {
        try {
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
                toast()->success('Berhasil Ganti Profile', 'Berhasil');
                $user->update();
                File::delete(storage_path('app'.'/'. $path . '/' . $oldfile));
                File::delete(public_path($path . '/' . $oldfile));
                return redirect()->back();
              }
        } catch (\Exception $e) {
              toast()->error($e, 'Eror');
              toast()->error('Terjadi Eror Saat Meng-Ganti Profil', 'Gagal');
              return redirect()->back();
        }
    }

    public function showpassword()
    {
      try {
        $user = Sentinel::getuser();
        return view('backend.user.password',compact('user'));
      } catch (\Exception $e) {
        toast()->error($e, 'Eror');
        toast()->error('Terjadi Eror Saat Meng-Load Data, Silakan Ulang Login kembali', 'Gagal');
        return redirect()->back();
      }


    }

    public function gantipassword(Request $request, $id)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|same:password_confirm',
        ]);
        try {
          $user = [
            "username"=>Sentinel::getuser()->username,
            "password"=>$request->old_password,
          ];
          if(Sentinel::stateless($user)){
            $user = User::find($id);
            $user->password = bcrypt($request->new_password);

            toast()->success('Ganti Password', 'Berhasil');
            $user->save();
            return redirect('dashboard');
          }else{
            toast()->error('password Lama Salah', 'Gagal');
            return redirect()->back();
          }
        } catch (\Exception $e) {
          toast()->error($e, 'Eror');
        }
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
