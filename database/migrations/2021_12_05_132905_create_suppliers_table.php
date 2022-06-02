<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {

            $table->id();

            // basic info
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('portalemail')->unique();
            $table->string('password');

            $table->string('address');
            $table->longText('locationlink')->nullable()->default('');

            $table->string('info')->nullable()->default('');


            // dates
            $table->string('startdate');
            $table->string('enddate');


            // files
            $table->longText('logo');
            $table->longText('contract');


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
        Schema::dropIfExists('suppliers');
    }
}
