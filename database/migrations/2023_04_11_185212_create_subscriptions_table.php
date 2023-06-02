<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('subscriptionRequestId');
            $table->integer('merchantId')->nullable();
            $table->string('merchantShortCode')->nullable();
            $table->string('payer')->nullable();
            $table->decimal('amount')->nullable();
            $table->dateTime('startDate')->nullable();
            $table->dateTime('expiryDate')->nullable();
            $table->string('frequency')->nullable();
            $table->string('status')->nullable();
            $table->string('cancelledBy')->nullable();
            $table->dateTime('cancelledTime')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
