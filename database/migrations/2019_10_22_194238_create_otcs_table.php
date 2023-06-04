<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otc_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->string('sms_template', 255);
            $table->string('email_subject_template', 255);
            $table->text('email_body_template');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('otcs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username', 100)->unique()->nullable();
            $table->string('mobile', 25)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('ot_code', 10)->nullable();
            $table->uuid('for_whom')->nullable();

            $table->foreign('for_whom')->references('id')->on('users')->onUpdate('cascade');

            $table->uuid('otc_type_id')->nullable();
            $table->foreign('otc_type_id')->references('id')->on('otc_types')->onUpdate('cascade');

            $table->timestamp("sms_sent_at")->nullable();
            $table->uuid('sms_sent_by_user_id')->nullable();
            $table->foreign('sms_sent_by_user_id')->references('id')->on('users')->onUpdate('cascade');

            $table->timestamp("email_sent_at")->nullable();
            $table->uuid('email_sent_by_user_id')->nullable();
            $table->foreign('email_sent_by_user_id')->references('id')->on('users')->onUpdate('cascade');

            $table->timestamp("sent_at")->nullable();
            $table->uuid('sent_by_user_id')->nullable();
            $table->foreign('sent_by_user_id')->references('id')->on('users')->onUpdate('cascade');

            $table->timestamp("verified_at")->nullable();
            $table->uuid('verified_by_user_id')->nullable();
            $table->foreign('verified_by_user_id')->references('id')->on('users')->onUpdate("cascade");

            $table->dateTime("expired_at")->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otcs');
        Schema::dropIfExists('otc_types');
    }
}
