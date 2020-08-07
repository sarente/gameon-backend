<?php

namespace App\Http\Requests\Api;

class TagRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'label'=> 'required|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'label' => trans('models.tag.label'),
        ];
    }
}
