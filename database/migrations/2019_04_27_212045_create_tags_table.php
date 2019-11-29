<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('wp_id');
            $table->timestamps();
            $table->string('title');
            $table->string('slug');
            $table->string('description')->nullable();
        });

        Schema::create('posts_tags', function (Blueprint $table) {
            $table->integer('posts_id');
            $table->integer('tags_id');

            $table->primary(['posts_id', 'tags_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('posts_tags');
    }
}
