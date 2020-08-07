<?php

namespace App\Http\Requests\Api;


class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'email'    => 'required|email|unique:users,email',
            'name'     => 'required',
            'username'     => 'required|digits:11',
            //'username'     => 'required|digits:11|unique:users',
            'password' => 'required',
            'gender' => 'required',
            'role' => 'nullable',
            //'provider' => 'nullable|in:facebook,google,googleid',
            //'token'    => 'required_with:provider',
        ];
    }

    public function attributes()
    {
        return [
            'email'    => trans('models.user.email'),
            'username'    => trans('models.user.username'),
            'name'     => trans('models.user.name'),
            'password' => trans('models.user.password'),
            'provider' => trans('models.social.provider'),
            'token'    => trans('models.social.token'),
        ];
    }
}
