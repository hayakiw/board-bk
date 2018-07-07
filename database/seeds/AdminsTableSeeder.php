<?php

use Illuminate\Database\Seeder;
use App\Models\Account;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'password' => bcrypt('admin'),
            ],
        ];

        foreach ($users as $u) {
            $account = Admin::where('name', '=', $u['name'])->first();
            if (!$account) {
                $account = new Admin();
            }

            foreach ($u as $k => $v) {
                $account->$k = $v;
            }
            $account->save();
        }
    }
}
