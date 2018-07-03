<?php

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountsTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'userid' => 'test',
                'password' => bcrypt('test'),
                'permit_application' => '1',
                'permit_loan' => '1',
                'permit_refund' => '1',
                'permit_statistic' => '1',
                'permit_master' => '1',
                'permit_negotiate' => '1',
                'permit_account' => '1',
            ],
        ];

        foreach ($users as $u) {
            $account = Account::where('userid', '=', $u['userid'])->first();
            if (!$account) {
                $account = new Account();
            }

            foreach ($u as $k => $v) {
                $account->$k = $v;
            }
            $account->save();
        }
    }
}
