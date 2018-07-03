<?php

namespace App\Http\Requests\Auth;
use App\Http\Requests\Request;

class SigninRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'userid' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'userid.required' => 'ユーザーIDを入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
