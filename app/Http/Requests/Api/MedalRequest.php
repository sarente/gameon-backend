<?php

namespace App\Http\Requests\Api;

class MedalRequest extends Request
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
            'description'=> 'required|max:255',
            "images"    => "nullable|array|min:1",
            "images.*"  => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }

}
