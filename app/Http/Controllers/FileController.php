<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function image($type, $file_id)
    {
    	$lokasi = null;
        if ($type == 'profile-pict') {
            $lokasi = 'img/avatars';
        }elseif ($type == 'bukti-pict') {
            $lokasi = 'img/foto_sks';
        }

        return response()->file(
                storage_path('app/'.$lokasi.'/'.$file_id)
            );
    }
}
