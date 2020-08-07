<?php

namespace App\Http\Requests\Api;

class PointRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'=> 'required',
            'point'=> 'required',
        ];
    }

    public function attributes()
    {
        return [
            'label' => trans('models.tag.label'),
        ];
    }
}
