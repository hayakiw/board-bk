<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SigninRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
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
            'name.required' => 'ユーザーIDを入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
