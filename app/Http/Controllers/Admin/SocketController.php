<?php

namespace App\Http\Controllers\Admin;

use App\Events\LevelUp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocketController extends Controller
{
    protected $transPrefix = 'models.socket.';

    public function index(Request $request)
    {
        //event(new LevelUp($request->user(), $request->user()));
        //return view('admin.socket-test.index')->with('transPrefix', $this->transPrefix);
        return view('admin.socket.index')->with('transPrefix', $this->transPrefix);
    }
}
