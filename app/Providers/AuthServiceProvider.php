<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 申請処理
        Gate::define('application', function ($user) {
            return $user->permit_application;
        });

        // 貸与処理
        Gate::define('loan', function ($user) {
            return $user->permit_loan;
        });

        // 返還処理
        Gate::define('refund', function ($user) {
            return $user->permit_refund;
        });

        // 統計資料等
        Gate::define('statistic', function ($user) {
            return $user->permit_statistic;
        });

        // マスタ管理
        Gate::define('master', function ($user) {
            return $user->permit_master;
        });

        // 交渉履歴
        Gate::define('negotiate', function ($user) {
            return $user->permit_negotiate;
        });

        // アカウント管理
        Gate::define('account', function ($user) {
            return $user->permit_account;
        });
    }
}
