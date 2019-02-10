<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePateintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pateints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('enter')->nullable();
            $table->date('leave')->nullable();
            $table->string('password');
            $table->string('icon')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender',['male', 'female']);
            $table->longText('description');
            $table->string('email')->unique()->nullable();

            $table->integer('department_id')->unsigned();
          //  $table->foreign('department_id')->references('id')
             //   ->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('pateints');
    }
}
