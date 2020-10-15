<?php

namespace App\Http\Requests\Api;

class ClubRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:255',
            'description' => 'nullable|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'classroom' => 'nullable'
        ];
    }
    public function attributes()
    {
        return [
            'name' => trans('models.club.name'),
        ];
    }
}
