<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            // general info
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable()->default('');


            // foregin department
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
