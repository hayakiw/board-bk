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
            $t->string('password', 255);
            $t->rememberToken();
            $t->timestamps();
            $t->softDeletes();
        });

        // ユーザー
        Schema::create('accounts', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->string('email')->unique();
            $t->string('password', 255)->nullable();
            $t->timestamp('is_signed_up')->nullable();

            $t->string('first_name', 100)->nullable();
            $t->string('last_name', 100)->nullable();
            $t->string('first_name_kana', 200)->nullable();
            $t->string('last_name_kana', 200)->nullable();

            $t->string('confirmation_token')->nullable();
            $t->timestamp('confirmation_sent_at')->nullable();
            $t->timestamp('confirmated_at')->nullable();

            $t->rememberToken();

            $t->timestamps();
            $t->softDeletes();
        });

        // ワークスペース
        Schema::create('workspaces', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->string('name', 255);
            $t->string('description')->nullable();

            $t->timestamps();
            $t->softDeletes();
        });

        // グループ
        Schema::create('groups', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->bigInteger('workspace_id')->unsigned();
            $t->string('title', 255);
            $t->string('description', 1000)->nullable();

            $t->timestamps();
            $t->softDeletes();
        });

        // 掲示板
        Schema::create('boards', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->bigInteger('group_id')->unsigned();
            $t->string('title', 255);
            $t->string('description', 1000)->nullable();

            $t->timestamps();
            $t->softDeletes();
        });

        // イベント
        Schema::create('events', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->bigInteger('group_id')->unsigned();
            $t->string('title', 255);
            $t->string('description', 1000)->nullable();

            $t->timestamps();
            $t->softDeletes();
        });

        // カテゴリ
        Schema::create('categories', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->morphs('categorizable');
            $t->string('name', 255);

            $t->timestamps();
            $t->softDeletes();
        });

        // コメント
        Schema::create('comments', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->string('comment', 1000);

            $t->morphs('commentable');

            $t->timestamps();
            $t->softDeletes();
        });

        // 添付ファイル
        Schema::create('attaches', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->string('path');
            
            $t->morphs('attacheable');

            $t->timestamps();
            $t->softDeletes();
        });

        // relations

        // ユーザー - ワークスペース
        Schema::create('accounts_workspaces', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->bigInteger('account_id')->unsigned();
            $t->bigInteger('workspace_id')->unsigned();

            $t->string('role');

            $t->timestamp('invite_at')->nullable();
            $t->timestamp('entry_at')->nullable();

            $t->timestamps();
            $t->softDeletes();
        });

        // ユーザー - グループ
        Schema::create('accounts_groups', function (Blueprint $t) {
            $t->bigIncrements('id');

            $t->bigInteger('account_id')->unsigned();
            $t->bigInteger('group_id')->unsigned();

            $t->string('role');

            $t->timestamp('invite_at')->nullable();
            $t->timestamp('entry_at')->nullable();

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
        Schema::dropIfExists('accounts_groups');
        Schema::dropIfExists('accounts_workspaces');
        Schema::dropIfExists('attaches');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('events');
        Schema::dropIfExists('boards');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('workspaces');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('admins');
    }
}
