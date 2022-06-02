<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerCustomerMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_customer_messages', function (Blueprint $table) {
            
            $table->id();

            $table->text('message');
            $table->string('type'); //sender - endsender
            $table->string('date');

            $table->integer('seen')->default(0); //seen (0)

            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');

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
        Schema::dropIfExists('partner_customer_messages');
    }
}
