<?php

namespace App\Http\Requests\Api;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class TaskRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        if(Auth::user()->hasRole([Setting::ROLE_STUDENT])){
            return [
                'status'=> 'required|max:255',
            ];
        }
        return [
            'name'=> 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'level' => 'required',
            "images"    => "nullable|array|min:1",
            "images.*"  => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            'assigned_user' => 'nullable',
            'assigned_classroom' => 'required_without:assigned_user',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('models.project.name'),
        ];
    }
}
