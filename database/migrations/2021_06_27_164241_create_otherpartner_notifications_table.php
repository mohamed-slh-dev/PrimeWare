<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherpartnerNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otherpartner_notifications', function (Blueprint $table) {

            $table->id();

            $table->string('shortinfo')->nullable()->default("");
            $table->text('longinfo')->nullable()->default("");

            $table->string('datetime');


            // route
            $table->string('linkroute')->nullable()->default("");

            // user who did the op
            $table->bigInteger('otherpartner_id')->unsigned()->nullable();
            $table->foreign('otherpartner_id')->references('id')->on('otherpartners');


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
        Schema::dropIfExists('otherpartner_notifications');
    }
}
