<?php

namespace App\Http\Requests\Api;

class PostRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'text'=> 'max:255',
            "images"    => "nullable|array|min:1",
            "images.*"  => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }

    /*public function attributes()
    {
        return [
            'text' => trans('models.post.name'),
        ];
    }*/
}
