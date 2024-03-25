<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('idx'); // 자동 증가되는 Primary Key
            $table->string('id', 45)->unique(); // VARCHAR(45)와 UNIQUE 제약조건
            $table->string('password', 255);
            $table->string('name', 255);
            $table->string('email', 255)->unique(); // E-mail은 일반적으로 UNIQUE 제약조건을 가집니다.
            $table->string('phone', 255);
            $table->string('remember_token', 255)->nullable(); // Nullable을 명시
            $table->timestamps(); // created_at과 updated_at 필드를 추가합니다.
            $table->softDeletes(); // Soft Delete를 위한 deleted_at 필드를 추가합니다.
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
