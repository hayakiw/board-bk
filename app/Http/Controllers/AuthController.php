<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\Auth as AuthRequest;
use App\Models\Account;

class AuthController extends Controller
{
    use ThrottlesLogins;

    public function signinForm()
    {
        return view('auth.signin_form');
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

        $credentials = $request->only('email', 'password');

        $remember = $request->has('remember');

        if (auth()->guard('web')->attempt($credentials, $remember)) {
            $this->clearLoginAttempts($request);

            // 処理日リセット
            // $request->session()->forget(Account::SESSION_KEY_DATE);

            return redirect()
                ->route('root.index')
                ->with('info', 'ログインしました。');
        }

        if (!$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return redirect()
            ->back()
            ->withInput($credentials)
            ->withErrors([
                'email' => '正しいユーザーID、パスワードを入力してください。',
            ]);
    }

    public function signout()
    {
        auth()->guard('web')->logout();
        return redirect()
            ->route('auth.signin')
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
