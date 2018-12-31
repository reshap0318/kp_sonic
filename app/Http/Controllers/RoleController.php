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
        $roles = Role::all();
        return view('backend.role.index',compact('roles'));
    }

    
    public function create()
    {
        $roles = Role::get()->pluck('name', 'id');
        return view('backend.role.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:roles',
            'name' => 'required',
        ]);
        $role = new Role;
        $role->slug = $request->slug;
        $role->name = $request->name;
        $role->permissions = ['{"home.dashboard":true}'];
        $role->save();

        return redirect()->route('role.index');
    }

    
    public function show($id)
    {
        $users = null;
        if($id){   
            $role = Sentinel::findRoleBySlug( $id);
            $users = $role->users()->get();
        }
        return view('backend.user.index',compact('users'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('backend.role.edit',compact('role'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'slug' => 'required',
            'name' => 'required',
        ]);
        $role = Role::find($id);
        $role->slug = $request->slug;
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index');
    }

    
    public function destroy($id)
    {
        $role = Role::find($id);
        if($role->delete()){
            return redirect()->route('role.index');
        }else{
            return redirect()->route('role.index');
        }
    }

    public function permissions($id)
    {
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
        return View('backEnd.role.permission', compact('role', 'actions'));
    }

    public function simpan($id, Request $request)
    {
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
        return redirect()->route('role.index');
    }
}
