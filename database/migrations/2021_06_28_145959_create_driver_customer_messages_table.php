<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverCustomerMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_customer_messages', function (Blueprint $table) {
            $table->id();

            $table->text('message');
            $table->string('type'); //sender - endsender
            $table->string('date');

            $table->integer('seen')->default(0); //seen (0)

            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');

            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');


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
        Schema::dropIfExists('driver_customer_messages');
    }
}
