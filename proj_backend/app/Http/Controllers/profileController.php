<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function getUserdetails(Request $req)
    {
        try {
            return response(Auth::user()->firstname, Auth::user()->lastname, Auth::user()->id);
        } catch (\Exception $e) {
            return response([
                'msg' => $e->getMessage()
            ]);
        }
    }
}
