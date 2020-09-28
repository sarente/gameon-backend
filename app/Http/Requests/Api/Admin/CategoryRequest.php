<?php

namespace App\Http\Requests\Api\Admin;

use App\Http\Requests\Request;

class CategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {   //FIXME: check unique
        return [
            'name.tr' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  trans('errors.category.not-found'),
        ];
    }
}
