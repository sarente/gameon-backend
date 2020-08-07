<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use App\Models\Language;

class QuestionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $locales = Language::requiredLocales();

        return [
            'text'=> 'required|max:255',
            "images"    => "nullable|array|min:1",
            "images.*"  => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ];
    }

    public function attributes()
    {
        return [
            'text' => trans('models.question.text'),
        ];
    }
}
