<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {

            $table->id();

            // basic info
            $table->string('name');
            $table->string('phone');
            $table->string('info')->nullable()->default('');
            $table->longText('pic');


            $table->string('email', 150);
            $table->string('password', 255);
            
            // special info
            $table->string('type'); //driver - collector
            $table->string('onlinestatus')->nullable()->default('offline'); //default false
            $table->string('shift')->nullable()->default(''); //night shift - morning


            $table->string('platenumber');
            $table->string('drivinglicense');
            $table->longText('licensepic')->nullable();
            $table->longText('carpic')->nullable();

            


            // foreginkeys
            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('optioncodes');


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
        Schema::dropIfExists('drivers');
    }
}
