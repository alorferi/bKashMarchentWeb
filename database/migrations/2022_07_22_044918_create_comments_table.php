<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_post_id')->default(0);
            $table->tinyText('comment_author');
            $table->string('comment_author_email',100)->default('');
            $table->string('comment_author_url',200)->default('');
            $table->string('comment_author_ip',100)->default('');
            $table->timestamp('comment_date')->useCurrent = true;
            $table->timestamp('comment_date_gmt')->useCurrent = true;
            $table->text('comment_content');
            $table->integer('comment_karma')->default(0);
            $table->string('comment_approved',20)->default('1');
            $table->string('comment_agent')->default('');
            $table->string('comment_type',20)->default('comment');
            $table->unsignedBigInteger('comment_parent')->default(0);
            $table->unsignedBigInteger('user_id')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['comment_post_id']);
            $table->index(['comment_approved','comment_date_gmt'],'comments_comment_approved_date_gmt');
            $table->index(['comment_date_gmt']);
            $table->index(['comment_parent']);
            $table->index(['comment_author_email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
