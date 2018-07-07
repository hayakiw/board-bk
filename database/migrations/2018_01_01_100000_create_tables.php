<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //--------------------------------------------------
        // テーブル作成
        //--------------------------------------------------
        // 管理者
        Schema::create('admins', function (Blueprint $t) {
            $t->bigIncrements('id');
            
            $t->string('name');
            $t->string('email')->unique();
            $t->string('password');
            $t->rememberToken();
            $t->timestamps();
        });

        // ユーザー
        Schema::create('accounts', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->string('email')->unique();
            $t->string('password', 255);

            $t->string('first_name');
            $t->string('last_name');
            $t->string('first_name_kana');
            $t->string('last_name_kana');

            $t->rememberToken();

            $t->timestamps();
            $t->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //--------------------------------------------------
        //テーブル削除
        //--------------------------------------------------
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('admins');
    }
}
