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
            return response(Auth::user()->firstname);
        } catch (\Exception $e) {
            return response([
                'msg' => $e->getMessage()
            ]);
        }
    }
}
