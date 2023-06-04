<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name')->unique();
            $table->string('merchant_display_name')->unique()->nullable();
            $table->tinyInteger('pre_notification_day')->nullable();
            $table->tinyInteger('no_of_retrial')->nullable();
            $table->string('retrial_period')->nullable();
            $table->tinyInteger('display_serial')->nullable();
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('payment_frequencies');
    }
}
