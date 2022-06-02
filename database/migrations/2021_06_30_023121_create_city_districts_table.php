<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_districts', function (Blueprint $table) {
            
            $table->id();

            // foreginkeys (city id - district id)
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
        Schema::dropIfExists('city_districts');
    }
}
