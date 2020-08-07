<?php

namespace App\Http\Requests\Api;

class ActivityRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            "images"    => "nullable|array|min:1",
            "images.*"  => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }

    public function attributes()
    {
        return [
            //'name' => trans('models.project.name'),
        ];
    }
}
