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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_author')->default(0);
            $table->timestamp('post_date')->useCurrent = true;
            $table->timestamp('post_date_gmt')->useCurrent = true;
            $table->longText('post_content');
            $table->text('post_title');
            $table->text('post_excerpt');
            $table->string('post_status',20)->default('draft');
            $table->string('comment_status',20)->default('open');
            $table->string('ping_status',20)->default('open');
            $table->string('post_password')->default('');
            $table->string('post_name',200)->default('');
            $table->text('to_ping');
            $table->text('pinged');
            $table->timestamp('post_modified')->useCurrent = true;
            $table->timestamp('post_modified_gmt')->useCurrent = true;
            $table->longText('post_content_filtered');
            $table->unsignedBigInteger('post_parent')->default(0);
            $table->string('guid')->default('');
            $table->integer('menu_order')->default(0);
            $table->string('post_type',20)->default('post');
            $table->string('post_mime_type',200)->default('');
            $table->bigInteger('comment_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['post_name']);
            $table->index(['post_type','post_status','post_date','id'],'posts_post_type_post_status_post_date');
            $table->index(['post_parent']);
            $table->index(['post_author']);
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
