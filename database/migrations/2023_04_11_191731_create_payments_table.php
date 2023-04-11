<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('subscriptionId');

            $table->dateTime('dueDate');
            $table->string('status');

            $table->string('trxId');
            $table->dateTime('trxTime');

            $table->decimal('amount');

            $table->decimal('reverseTrxAmount')->nullable();
            $table->string('reverseTrxId')->nullable();
            $table->dateTime('reverseTrxTime')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
