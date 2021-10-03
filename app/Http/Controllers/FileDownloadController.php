<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileDownloadController extends Controller
{
    public function DownloadFile($id)
    {
        $seller     = Seller::find($id);
        $extension  = explode('.',$seller->file);
        $fileName   = $seller->user->full_name . '.' . $extension[1];
        $file       = storage_path('app\files\\') . $seller->file;
        $headers    = array(
            'Content-Type: application/' . $extension[1],
        );
        // dd(1);
        return response()->download($file,$fileName,$headers);
    }
}
