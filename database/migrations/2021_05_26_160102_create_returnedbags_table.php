<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnedbagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returnedbags', function (Blueprint $table) {

            $table->id();

            // partner id / driver id
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');

            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');

            $table->integer('bags')->nullable()->default(0);

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
        Schema::dropIfExists('returnedbags');
    }
}
