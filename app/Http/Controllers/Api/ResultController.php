<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Result;


class ResultController extends Controller
{
    public function show($id)
    {
        $result = Result::with('rewards.image')->findOrFail($id);
        return response()->success($result);
    }

}
