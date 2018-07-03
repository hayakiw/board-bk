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
        Schema::create('accounts', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->string('userid');
            $t->string('password', 255);

            $t->tinyInteger('permit_application')->unsigned()->comment('申請処理');
            $t->tinyInteger('permit_loan')->unsigned()->comment('貸与処理');
            $t->tinyInteger('permit_refund')->unsigned()->comment('返還処理');
            $t->tinyInteger('permit_statistic')->unsigned()->comment('統計資料等');
            $t->tinyInteger('permit_master')->unsigned()->comment('マスタ管理');
            $t->tinyInteger('permit_negotiate')->unsigned()->comment('交渉履歴');
            $t->tinyInteger('permit_account')->unsigned()->comment('アカウント管理');

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
    }
}
