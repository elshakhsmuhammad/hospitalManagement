<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReckoningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reckonings', function (Blueprint $table) {
            $table->increments('id');
            $table->date('create')->nullable();
            $table->integer('patient_id')->unsigned();
         //   $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->integer('staff_id')->unsigned();
           // $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->integer('medicine_id')->unsigned();
          //  $table->foreign('medicine_id')->references('id')->on('medicine')->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->integer('day')->nullable();
            $table->float('price')->nullable();
            $table->integer('Surgeries_price')->nullable();
            $table->integer('other')->nullable();
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
        Schema::dropIfExists('reckonings');
    }
}
