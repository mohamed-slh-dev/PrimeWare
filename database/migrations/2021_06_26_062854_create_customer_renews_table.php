<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRenewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_renews', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('startdate')->nullable()->default(0);
            $table->integer('deliveriescount')->nullable()->default(0);
            

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
        Schema::dropIfExists('customer_renews');
    }
}
