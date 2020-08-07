<?php

namespace App\Http\Requests\Api;

class StepRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'nullable|max:100',
            'description'=> 'nullable|max:255',
        ];
    }
}
