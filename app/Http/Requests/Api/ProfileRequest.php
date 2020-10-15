<?php

namespace App\Http\Requests\Api;

class ProfileRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description'=> 'nullable|max:500',
            "images"    => "nullable|array|min:1",
            //"images.*"  => "nullable|base64|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }
}
