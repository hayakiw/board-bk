<?php

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountsTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'email' => 'test@example.com',
                'password' => bcrypt('test'),
                'first_name' => 'test',
                'last_name' => 'user',
                'first_name_kana' => 'test',
                'last_name_kana' => 'user',
            ],
        ];

        foreach ($users as $u) {
            $account = Account::where('email', '=', $u['email'])->first();
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
