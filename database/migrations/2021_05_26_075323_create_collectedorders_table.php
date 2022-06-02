<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectedordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collectedorders', function (Blueprint $table) {
            $table->id();

            // foregin keys (order id / partner id / customer id / driver id)
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');

            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');



            // order info
            $table->string('servicetype'); //special - subscription
            $table->string('servicetiming'); //timing (represent morning - night shifts)
            
            $table->string('status'); //pending - delivered - canceled

            $table->double('cashcollected', 20)->unsigned()->default(0);
            $table->double('chargefees')->unsigned()->default(0);


            // bag - default = 0 if found then 1
            $table->integer('bag')->nullable()->default(0);

            //delivery date - any update on status date
            $table->string('deliverydate');
            $table->string('updatedate');

            // more info
            $table->string('info');


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
        Schema::dropIfExists('collectedorders');
    }
}