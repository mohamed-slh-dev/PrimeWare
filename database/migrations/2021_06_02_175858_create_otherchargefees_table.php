<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherchargefeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otherchargefees', function (Blueprint $table) {
            
            $table->id();

            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('optioncodes');

            $table->integer('vantodayfees')->nullable()->default(0);
            $table->integer('vannextdayfees')->nullable()->default(0);

            $table->integer('biketodayfees')->nullable()->default(0);
            $table->integer('bikenextdayfees')->nullable()->default(0);


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
        Schema::dropIfExists('otherchargefees');
    }
}
