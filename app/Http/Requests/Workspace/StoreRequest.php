<?php

namespace App\Http\Requests\Workspace;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required',
            ],
            'description' => [
                'required'
            ],
            'invites.*.email' => [
                'required',
                'max:255',
            ],
        ];

        return $rules;
    }

    public function messages()
    {
        return [];
    }

    public function atributes()
    {
        return [
            'name' => 'ワークスペース名',
            'description' => 'ワークスペースの説明',
            'invites.*.email' => 'ユーザーの招待Eメール',
        ];
    }
}
