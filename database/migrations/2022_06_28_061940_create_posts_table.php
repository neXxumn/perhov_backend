<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $post) {
            $post->id();
            $post->integer('user_id')->constrained('users');
            $post->string('title')->nullable(false);
            $post->text('content')->nullable(false);
            $post->string('image')->nullable(false);
            $post->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts', function (Blueprint $post) {
            $post->dropForeign(['user_id']);
        });
    }
}
