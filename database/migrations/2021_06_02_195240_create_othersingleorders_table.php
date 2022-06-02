<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersingleordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('othersingleorders', function (Blueprint $table) {

            $table->id();


            // order reference
            $table->string('referenceid')->nullable()->default('');

            // customer
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->longText('customer_locationlink');

         



            // foregin keys (partner id / driver id)
            $table->bigInteger('otherpartner_id')->unsigned()->nullable();
            $table->foreign('otherpartner_id')->references('id')->on('otherpartners');

            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');


            // foregin keys (city id - district id)
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('optioncodes');

            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->foreign('district_id')->references('id')->on('optioncodes');




            // order info
            $table->string('packagetype');

            $table->string('carriage'); //van or bike
            $table->integer('numberofcarriage')->nullable()->default(0); //van or bike


            $table->string('servicetype'); 

            $table->string('status');
            $table->string('paymentstatus')->nullable()->default('not paid'); 
            

            // $table->double('cashcollected', 20)->unsigned()->default(0);
            $table->double('chargefees')->unsigned()->default(0);


            //delivery date - any update on status date
            $table->string('deliverydate'); //today or next day date
            $table->string('updatedate')->nullable()->default('');

            $table->longText('pickuplocationlink');

            $table->string('pickuptime');
            $table->string('deliverytime');


            $table->string('info')->nullable()->default('');
            

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
        Schema::dropIfExists('othersingleorders');
    }
}
