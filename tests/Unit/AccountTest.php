<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Account;

class AccountTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    protected $accountData = [];

    protected function setUp()
    {
        parent::setUp();

        $this->accountData = [
            'email' => $this->faker->email,
            'password' => 'password',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
        ];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetName()
    {
        $account = Account::create($this->accountData);
        $this->assertSame($this->accountData['first_name'], $account->getName());
    }

    public function testGetFullName()
    {
        $account = Account::create($this->accountData);
        $this->assertSame(sprintf(
            '%s %s',
            $this->accountData['last_name'], $this->accountData['first_name']
        ), $account->getFullName());
    }
}
