<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_districts', function (Blueprint $table) {


            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');

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
        Schema::dropIfExists('driver_districts');
    }
}
