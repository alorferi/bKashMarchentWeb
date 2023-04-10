<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_taxonomy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('term_id')->default(0);
            $table->string('taxonomy',32)->default('');
            $table->longText('description');
            $table->unsignedBigInteger('parent')->default(0);
            $table->bigInteger('count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['term_id','taxonomy']);

            $table->index(['taxonomy']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_taxonomy');
    }
}
