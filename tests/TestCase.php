<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Contracts\Console\Kernel;

abstract class TestCase extends BaseTestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    protected static $initDatabase = false;

    public function setUpDatabase()
    {
        //テスト用DBを使用
        config(['database.default' => 'mysql_tests']);

        if (!static::$initDatabase) {
            \Artisan::call('migrate:reset');
            \Artisan::call('migrate');
            static::$initDatabase = true;

            return;
        }

        DB::table('admins')->delete();
        DB::table('users')->delete();
    }
}
