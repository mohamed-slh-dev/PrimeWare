<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // foregin keys (partner id / customer id / driver id)
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
            $table->string('updatedate')->nullable()->default('');


            // received pic (received from app)
            $table->string('receivedpic')->nullable()->default('');


            // more info
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
        Schema::dropIfExists('orders');
    }
}
