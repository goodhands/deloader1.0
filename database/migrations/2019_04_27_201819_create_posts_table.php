<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wp_id');
            $table->timestamps();
            $table->string('slug');
            $table->smallInteger('featured')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('title');
            $table->longText('content')->change();
            $table->string('excerpt', 250)->nullable();
            $table->integer('author_id');
            $table->integer('comment_allowed')->nullable();
            $table->string('featured_image')->nullable();
            $table->integer('category_id');
            $table->year('year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
