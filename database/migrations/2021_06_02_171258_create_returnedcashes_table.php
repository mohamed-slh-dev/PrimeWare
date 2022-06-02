<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnedcashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnedcashes', function (Blueprint $table) {

            $table->id();

            // general
            $table->double('amount', 20)->nullable()->default(0);
            $table->string('comment')->nullable()->default('');
            $table->string('date')->nullable()->default('');
            $table->string('status')->nullable()->default('not confirmed');


            // foregin keys
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');

            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');




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
        Schema::dropIfExists('returnedcashes');
    }
}
