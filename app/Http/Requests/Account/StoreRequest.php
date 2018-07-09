<?php
namespace App\Http\Requests\Account;

use App\Http\Requests\Request;
use App\Models\Account;

class StoreRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !\Auth::guard('web')->check();
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'unique:accounts,email',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.unique' => 'すでに登録されたメールアドレスです',
        ];
    }
}
