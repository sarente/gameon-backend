<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use App\Models\Language;

class IntroductionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        $locales = Language::requiredLocales();

        $rules = [
            'order' => 'required',
            //'type' => 'required',
        ];

        foreach ($locales as $locale) {
            $rules['text:' . $locale] = 'text';
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'text' => trans('models.question.text'),
        ];


        $locales = Language::locales();

        foreach ($locales as $locale) {
            $attributes['text:' . $locale] = trans('models.question.text') . ' ' . '(' . $locale . ')';
        }

        return $attributes;
    }
}
