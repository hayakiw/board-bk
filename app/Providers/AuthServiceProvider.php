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

        // �\������
        Gate::define('application', function ($user) {
            return $user->permit_application;
        });

        // �ݗ^����
        Gate::define('loan', function ($user) {
            return $user->permit_loan;
        });

        // �Ԋҏ���
        Gate::define('refund', function ($user) {
            return $user->permit_refund;
        });

        // ���v������
        Gate::define('statistic', function ($user) {
            return $user->permit_statistic;
        });

        // �}�X�^�Ǘ�
        Gate::define('master', function ($user) {
            return $user->permit_master;
        });

        // ������
        Gate::define('negotiate', function ($user) {
            return $user->permit_negotiate;
        });

        // �A�J�E���g�Ǘ�
        Gate::define('account', function ($user) {
            return $user->permit_account;
        });
    }
}
