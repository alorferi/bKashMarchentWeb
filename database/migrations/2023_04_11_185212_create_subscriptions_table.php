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
            $table->dateTime('createdAt');
            $table->dateTime('modifiedAt');
            $table->string('subscriptionRequestId');
            $table->unsignedInteger('requesterId');
            $table->unsignedInteger('serviceId');
            $table->string('paymentType');
            $table->string('subscriptionType');
            $table->string('amountQueryUrl')->nullable();
            $table->decimal('amount');
            $table->decimal('firstPaymentAmount')->nullable();
            $table->boolean('maxCapRequired');
            $table->decimal('maxCapAmount')->nullable();
            $table->string('frequency');
            $table->dateTime('startDate');
            $table->dateTime('expiryDate');
            $table->integer('merchantId');
            $table->string('merchantShortCode')->nullable();
            $table->string('payerType');
            $table->string('payer')->nullable();
            $table->string('currency');
            $table->string('nextPaymentDate');
            $table->string('status');
            $table->string('subscriptionReference');
            $table->string('extraParams')->nullable();
            $table->string('cancelledBy')->nullable();
            $table->dateTime('cancelledTime')->nullable();
            $table->boolean('enabled');
            $table->boolean('expired');
            $table->string('rrule');
            $table->boolean('active');
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
