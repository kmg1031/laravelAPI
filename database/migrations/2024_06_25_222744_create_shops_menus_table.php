<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops_menus', function (Blueprint $table) {
            $table->increments('menu_idx');
            $table->unsignedInteger('shop_idx');
            $table->string('menu_name'); // 메뉴 이름
            $table->text('menu_description')->nullable(); // 메뉴 설명
            $table->decimal('menu_price', 10, 2); // 메뉴 가격
            $table->string('menu_category')->nullable(); // 메뉴 카테고리
            $table->timestamp('created_at')->useCurrent(); // 메뉴 생성일
            $table->timestamp('updated_at')->useCurrent()->nullable(); // 메뉴 수정일
            $table->boolean('is_available')->default(true); // 메뉴 제공 여부
            $table->string('menu_image_url')->nullable(); // 메뉴 이미지 URL
            $table->softDeletes(); // deleted_at 필드를 생성합니다.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops_menus');
    }
}
