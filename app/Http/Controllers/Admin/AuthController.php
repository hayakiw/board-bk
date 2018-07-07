<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\Admin\Auth as AuthRequest;
use App\Models\Admin;

class AuthController extends Controller
{
    use ThrottlesLogins;

    public function signinForm()
    {
        return view('admin.auth.signin_form');
    }

    /**
     * ログイン実行
     *
     * @param AuthRequest\SigninRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signin(AuthRequest\SigninRequest $request)
    {
        if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            /* @throws \Illuminate\Validation\ValidationException */
            $this->sendLockoutResponse($request);
        }

        $credentials = $request->only('name', 'password');

        $remember = $request->has('remember');

        if (auth()->guard('admin')->attempt($credentials, $remember)) {
            $this->clearLoginAttempts($request);

            // 処理日リセット
            // $request->session()->forget(Account::SESSION_KEY_DATE);

            return redirect()
                ->route('admin.root.index')
                ->with('info', 'ログインしました。');
        }
        if (!$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return redirect()
            ->back()
            ->withInput($credentials)
            ->withErrors([
                'name' => '正しいユーザーID、パスワードを入力してください。',
            ]);
    }

    public function signout()
    {
        auth()->guard('admin')->logout();
        return redirect()
            ->route('admin.auth.signin')
            ->with('info', 'ログアウトしました。')
            ;
    }


    protected function username()
    {
        return 'userid';
    }


    protected function loginUsername()
    {
        return 'userid';
    }

    protected function getLockoutErrorMessage($seconds)
    {
        return 'しばらく時間をおいてもう一度やり直してください。';
    }
}
