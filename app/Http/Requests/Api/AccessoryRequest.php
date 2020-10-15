<?php

namespace App\Http\Requests\Api;

class AccessoryRequest extends Request
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
            'image' => 'nullable|image',
        ];
    }

}
