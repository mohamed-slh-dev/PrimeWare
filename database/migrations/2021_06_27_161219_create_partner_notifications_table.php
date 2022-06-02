<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_notifications', function (Blueprint $table) {

            $table->id();

            $table->string('shortinfo')->nullable()->default("");
            $table->text('longinfo')->nullable()->default("");

            $table->string('datetime');


            // route
            $table->string('linkroute')->nullable()->default("");

            // user who did the op
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');


            // not seen = 0
            $table->integer('seen')->nullable()->default(0);

            // only 1 when notification come from app (this showed in notification)
            $table->integer('fromapp')->nullable()->default(0);


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
        Schema::dropIfExists('partner_notifications');
    }
}
