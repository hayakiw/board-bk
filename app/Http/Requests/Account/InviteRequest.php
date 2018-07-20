<?php
namespace App\Http\Requests\Account;

use App\Http\Requests\Request;
use App\Models\Account;

class InviteRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::guard('web')->check();
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
        ];
    }
}
