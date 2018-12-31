<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\user;
use Redirect;
use Carbon\Carbon;

class QrLoginController extends Controller
{
     public function qr1()
    {
    	//dd('berhasil');
    	return view('Auth.QrLogin');
    }

    public function qr2()
    {
    	return view('Auth.QrLogin2');
    }

    public function MyQrCode()
	{
		$user = Sentinel::getuser();
		$pemilik = 'saya';
		return view('backend.user.qrcode',compact('user','pemilik'));
	}

	public function UserQrCode($id)
	{
		$user = Sentinel::findById($id);
		//dd($user);
		$pemilik = 'bukan-saya';
		return view('backend.user.qrcode',compact('user','pemilik'));
	}

	public function checkUser(Request $request)
	{
		$result =0;
		if ($request->data)
		{
      $users = User::where('QRpassword',$request->data)->first();
	    if($user = Sentinel::authenticate($users))
      {
        $result =1;
      }
		}
		return $result;
	}

	public function QrAutoGenerate(Request $request)
	{
		$result=0;
		if ($request->action = 'updateqr') {
			$user = Sentinel::getUser();
			if ($user) {
				$qrLogin=bcrypt($user->personal_number.$user->email.str_random(40));
		        $user->QRpassword= $qrLogin;
		        $user->update();
		        $result=1;
			}

		}

        return $result;
	}
}
