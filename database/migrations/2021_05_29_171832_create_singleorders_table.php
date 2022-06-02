<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('singleorders', function (Blueprint $table) {

            $table->id();

            // customer info
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->longText('customer_locationlink');


            

            // foregin keys (partner id / driver id)
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');

            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');


            // foregin keys (city id - district id)
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('optioncodes');

            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->foreign('district_id')->references('id')->on('optioncodes');




            // order info

            $table->string('servicetype'); //one time
            $table->string('status'); //pending - delivered - canceled

            $table->double('cashcollected', 20)->unsigned()->default(0);
            $table->double('chargefees')->unsigned()->default(0);


            //delivery date - any update on status date
            $table->string('deliverydate');
            $table->string('updatedate')->nullable()->default('');

            $table->string('pickuptime');
            $table->string('deliverytime');

            

            // meal
            $table->string('meal')->nullable()->default('');

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
        Schema::dropIfExists('singleorders');
    }
}
