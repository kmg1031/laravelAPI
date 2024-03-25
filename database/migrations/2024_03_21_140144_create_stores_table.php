<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('idx');
            $table->string('name');
            $table->string('location');
            $table->timestamps(); // created_at과 updated_at 필드를 자동으로 생성합니다.
            $table->integer('is_all_day')->nullable()->default(1); // boolean 타입으로 변경했습니다.
            $table->timestamp('opened_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->softDeletes(); // deleted_at 필드를 생성합니다.
        });
    }

    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
