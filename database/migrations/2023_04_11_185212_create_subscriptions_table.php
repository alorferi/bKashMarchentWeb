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
            $table->id();
            $table->string('subscriptionRequestId');
            $table->integer('merchantId');
            $table->string('merchantShortCode')->nullable();
            $table->string('payer');
            $table->decimal('amount');
            $table->dateTime('startDate');
            $table->dateTime('expiryDate');
            $table->string('frequency');
            $table->string('status');
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
