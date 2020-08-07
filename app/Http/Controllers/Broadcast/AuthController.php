<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Request;

use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(auth()->user()){
           //Log::info('logged by socket-----'.auth()->user()->name);
           return auth()->user()->name;
       }
       return false;
        //JWTAuth::parseToken()->authenticate();
    }
}
