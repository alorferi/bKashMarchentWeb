<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_login',60)->default('');
            $table->string('password')->default('');
            $table->string('user_nicename',50)->default('');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_url',100)->default('');
            $table->timestamp('user_registered')->useCurrent = true;
            $table->string('user_activation_key')->default('');
            $table->integer('user_status')->default(0);
            $table->string('name');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
