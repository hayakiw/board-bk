<?php

namespace App\Http\Requests\Account;
use App\Http\Requests\Request;

class ActivateRequest extends Request
{
    public function authorize()
    {
        return !\Auth::guard('web')->check();
    }

    public function rules()
    {
        $rules = [
            'last_name' => [
                'required',
                'max:100',
            ],
            'first_name' => [
                'required',
                'max:100',
            ],
            'last_name_kana' => [
                'required',
                'max:200',
            ],
            'first_name_kana' => [
                'required',
                'max:200',
            ],
            'password' => [
                'required',
                'max:255',
                'min:4',
                'alpha_num',
            ],
            'password_comfirmation' => [
                'same:password',
            ],
        ];

        // 招待者のきりわけ
        if (!$this->has('workspace_id')) {
            $rules = array_merge($rules, [
                'workspace.name' => [
                    'required',
                    'max:255',
                    'unique:workspaces,name',
                ],
                'workspace.description' => [
                    'required',
                    'max:1000',
                ],
            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'last_name.max' => '姓は :max 文字までです',
            'first_name.required' => '名を入力してください',
            'first_name.max' => '名は :max 文字までです',
            'last_name_kana.required' => 'セイを入力してください',
            'last_name_kana.max' => 'セイは :max 文字までです',
            'first_name_kana.required' => 'メイを入力してください',
            'first_name_kana.max' => 'メイは :max 文字までです',
            'password.required' => 'パスワードを入力してください',
            'password.max' => 'パスワードは :max 文字までです',
            'password.alpha_num' => 'パスワードを入力してください',
            'password_comfirmation.same' => 'パスワードが一致しません',
            
            'workspace.name.required' => 'ワークスペース名を入力してください',
            'workspace.name.max' => 'ワークスペース名は :max 文字までです',
            'workspace.name.unique' => 'ワークスペース名はすでに使用されています',
            'workspace.description.required' => 'ワークスペースの説明を入力してください',
            'workspace.description.max' => 'ワークスペースの説明は :max 文字までです',
        ];
    }
}
