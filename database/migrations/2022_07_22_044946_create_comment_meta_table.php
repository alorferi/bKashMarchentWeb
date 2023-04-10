<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_meta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_id')->default(0);
            $table->string('meta_key')->nullable();
            $table->longText('meta_value')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['comment_id']);
            $table->index(['meta_key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_meta');
    }
}
