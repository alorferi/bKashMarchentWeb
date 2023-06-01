<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onboards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->decimal('amount');
            $table->string('frequency');
            $table->dateTime('startDate')->nullable();
            $table->dateTime('expiryDate')->nullable();
            $table->string('subscriptionRequestId')->nullable();
            $table->dateTime('expirationTime')->nullable();
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
        Schema::dropIfExists('onboards');
    }
}
