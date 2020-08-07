<?php

namespace App\Http\Requests\Api;

class DocumentRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'document' => 'required|file|mimes:doc,docx,rtf,gif,pdf,txt|max:10000',
        ];
    }
}
