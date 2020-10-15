<?php

namespace App\Http\Requests\Api;

class MessageRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message'=> 'required|max:1000',
            'message_type' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'name' => trans('models.club.name'),
        ];
    }
}
