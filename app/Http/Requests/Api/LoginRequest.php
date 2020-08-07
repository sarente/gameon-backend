<?php

namespace App\Http\Requests\Api;


class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'exists:users,username',
            'email' => 'required_without:username|email',
            'password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'username' => trans('models.user.username'),
            'email' => trans('models.user.email'),
            'password' => trans('models.user.password'),
        ];
    }
}
