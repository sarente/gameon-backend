<?php

namespace App\Http\Requests\Api;

class LevelRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'total_xp'=> 'required',
            'project_xp'=> 'required',
            'task_xp'=> 'required',
            'qa_xp'=> 'required',
            'club_xp'=> 'required',
        ];
    }

    public function attributes()
    {
        return [
            //'label' => trans('models.tag.label'),
        ];
    }
}
