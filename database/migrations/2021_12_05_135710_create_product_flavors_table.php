<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFlavorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_flavors', function (Blueprint $table) {

            $table->id();

            // dates
            $table->string('name');
            $table->double('price', 20)->nullable()->default(0);
            $table->integer('quantity')->unsigned()->nullable();

            $table->string('cals');
            $table->string('proteins');
            $table->string('carbs');
            $table->string('fats');


            // received / availble / sold / damaged quantity (default 0)
            $table->integer('received')->unsigned()->nullable();
            $table->integer('available')->unsigned()->nullable();
            $table->integer('sold')->unsigned()->nullable();
            $table->integer('damaged')->unsigned()->nullable();

            
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');

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
        Schema::dropIfExists('product_flavors');
    }
}
