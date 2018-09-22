<?php
namespace App\Http\Requests\Workspace;

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
        $rules = [];
        if (!$this->has('invites')) {
            $rules['invite'] = [
                'required',
            ];
        } elseif (count($this->only('invites')['invites']) == 0) {
            $rules['invite'] = [
                'required',
            ];
        }
        $rules['invites.*.email'] = [
            'required',
            'email',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'invite.required' => '招待する人を追加してください。',
            'invites.*.email.required' => 'メールアドレスを入力してください',
        ];
    }
}
