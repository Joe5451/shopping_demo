<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->increments('cart_id');
            $table->integer('member_id')->comment('會員 id');
            $table->integer('product_id')->comment('商品 id');
            $table->string('product_name', 255)->default('')->comment('商品名稱');
            $table->string('product_img', 500)->default('')->comment('商品圖片');
            $table->mediumInteger('price')->default(0)->comment('價格');
            $table->smallInteger('quantity')->default(0)->comment('數量');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
