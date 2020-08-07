<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function index()
    {
        $categories = Status::all();

        if (!$categories) {
            return response()->error('error.not-found');
        }
        return response()->success($categories);
    }

    public function store(Request $request)
    {
        $status_name = $request->only('name');
        $status = Status::where('name', $status_name)->exists();

        if ($status) {
            return response()->error('status.name-valid');
        }

        $model = new Status($request->input());
        $model->save();

        return response()->success('common.success');
    }

    public function show($id){
        $status = Status::find($id);
        if (!$status) {
            return response()->error('medal.not-found');
        }
        return response()->success($status);
    }
}
