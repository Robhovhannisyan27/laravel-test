<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('category_id')->unsigned()->index();
            $table->string('text');
            $table->integer('user_id');
            $table->string('image')->default('no-image.png');
            $table->timestamps();
            $table->longtext('longtext');

            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_category_id_foreign');
        });
        Schema::dropIfExists('posts');
    }
}
