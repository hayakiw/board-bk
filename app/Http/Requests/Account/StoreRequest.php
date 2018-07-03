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
        return \Auth::guard('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userid' => [
                'required',
                'between:4,10',
                'unique:accounts,userid,NULL,id,deleted_at,NULL',
                'ascii',
            ],
            'password' => [
                'required',
                'between:4,10',
                'ascii',
            ],
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'userid.required' => '"ユーザーID"は必ず入力してください',
            'userid.unique' => '入力した“ユーザーID”は既に登録されています',
            'userid.between' => '"ユーザーID"は:min〜:max文字で入力してください',
            'userid.ascii' => '"ユーザーID"を正しく入力してください',
            'password.required' => '“パスワード"は必ず入力してください',
            'password.between' => '"パスワード"は:min〜:max文字で入力してください',
            'password.ascii' => '"パスワード"を正しく入力してください',
        ];
    }
}
