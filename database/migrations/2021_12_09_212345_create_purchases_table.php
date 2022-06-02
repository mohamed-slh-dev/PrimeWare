<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->string('fname')->nullable();
            $table->string('lname')->nullable();
            $table->text('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('block')->nullable();
            $table->string('floor')->nullable();
            $table->string('flat')->nullable();
            $table->string('address')->nullable();
            $table->text('location')->nullable()->default('');

            $table->string('delivery_date')->nullable();
            $table->string('status')->nullable();
            $table->string('tracking_number')->nullable();

            $table->double('price', 15, 2)->nullable()->default(0);


            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('optioncodes');

            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->foreign('district_id')->references('id')->on('optioncodes');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
