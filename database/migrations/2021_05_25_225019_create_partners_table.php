<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {

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

            // collection timing from / to
            $table->string('collectiontimingfrom')->nullable()->default('');
            $table->string('collectiontimingto')->nullable()->default('');



            // files
            $table->longText('logo');
            $table->longText('contract');


            // foreginkeys
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('optioncodes');

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
        Schema::dropIfExists('partners');
    }
}
