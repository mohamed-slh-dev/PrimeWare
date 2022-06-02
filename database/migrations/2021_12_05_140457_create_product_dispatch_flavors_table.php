<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDispatchFlavorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_dispatch_flavors', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('product_dispatch_id')->unsigned()->nullable();
            $table->foreign('product_dispatch_id')->references('id')->on('product_dispatches');

            $table->bigInteger('product_flavor_id')->unsigned()->nullable();
            $table->foreign('product_flavor_id')->references('id')->on('product_flavors');

            $table->integer('quantity')->unsigned()->nullable();
            $table->double('price', 20)->nullable()->default(0);

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
        Schema::dropIfExists('product_dispatch_flavors');
    }
}
