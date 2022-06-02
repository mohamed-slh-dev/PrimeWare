<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->id();

            // basic info
            $table->string('name');
            $table->string('phone');
            $table->string('flatnumber');
            
            $table->string('address'); 
            $table->string('blocknumber');
            $table->longText('locationlink')->nullable()->default('');

            $table->string('onlinestatus')->nullable()->default('offline');


            // service info
            $table->string('servicetype'); //subscription - special
            $table->string('servicetiming')->nullable()->default(''); //nightshit - morningshift

            $table->integer('deliverydaysnumber')->nullable()->default(0);
            $table->string('deliverydays')->nullable()->default('');

            $table->double('cashcollected', 20)->unsigned()->default(0);
            $table->integer('totalbags')->nullable()->default(0);

            // calc from orders (fees * orders)
            $table->bigInteger('totalfees')->nullable()->default(0);




            // subscription start date + enddate
            $table->string('substartdate');
            $table->string('subenddate');

            // more info
            $table->string('info')->nullable()->default('');



            // extras for special (service type)
            $table->string('specialpickuptime')->nullable()->default('');
            $table->string('specialdeliverytime')->nullable()->default('');



            // foreginkeys (link to another customer like fam member and so)
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');


            $table->bigInteger('linkedcustomer')->unsigned()->nullable();
            $table->foreign('linkedcustomer')->references('id')->on('customers');


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
        Schema::dropIfExists('customers');
    }
}
