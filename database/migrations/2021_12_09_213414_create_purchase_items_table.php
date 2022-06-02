<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            
            $table->id();

            $table->bigInteger('purchase_id')->unsigned()->nullable();
            $table->foreign('purchase_id')->references('id')->on('purchases');

            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');

            $table->bigInteger('product_flavor_id')->unsigned()->nullable();
            $table->foreign('product_flavor_id')->references('id')->on('product_flavors');

            $table->integer('quantity')->unsigned()->nullable()->default(0);

            $table->double('price', 15, 2)->nullable()->default(0);

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
        Schema::dropIfExists('purchase_items');
    }
}
