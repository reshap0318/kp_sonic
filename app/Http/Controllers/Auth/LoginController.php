<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Carbon\Carbon;

class LoginController extends Controller
{
    use ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected $redirectTo = 'dashboard';

    public function nrp_nip()
    {
        return 'nrp_nip';
    }

    public function showLoginForm()
    {
      //fungsi cek untuk mengetahui user sudah login atau belum
      if(Sentinel::check()){
        return redirect()->back();
      }else{
        return view('auth.login');
      }

    }

    protected function login(Request $request)
    {
        $request->validate([
            'nrp_nip' => 'required',
            'password' => 'required',
        ]);
        if ($user = Sentinel::authenticate($request->all()))
        {
           return redirect('dashboard');
        }else{
            return redirect()->back();
        }
    }

    protected function logout()
    {
        Sentinel::logout();
        return redirect('/');
    }
}
