<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();

            $table->string('shortinfo')->nullable()->default("");
            $table->text('longinfo')->nullable()->default("");

            $table->string('datetime');
        

            // route
            $table->string('linkroute')->nullable()->default("");

            // user who did the op
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');


            // one of them will be null
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');

            $table->bigInteger('otherpartner_id')->unsigned()->nullable();
            $table->foreign('otherpartner_id')->references('id')->on('otherpartners');
            

            // not seen  = 0
            $table->integer('seen')->nullable()->default(1);


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
        Schema::dropIfExists('user_notifications');
    }
}
