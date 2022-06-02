<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {

            $table->id();

            // general info
            $table->string('name');

            $table->string('model')->nullable()->default('');
            $table->longText('pic')->nullable()->default('');
            $table->string('serialnumber')->nullable()->default('');

            $table->string('status');
            $table->string('info')->nullable()->default('');

            // foregin keys
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
        Schema::dropIfExists('assets');
    }
}
