<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->unsigned();
          //  $table->foreign('patient_id')->references('id')
             //   ->on('patients')->onDelete('cascade');

            $table->integer('staff_id')->unsigned();
           // $table->foreign('staff_id')->references('id')
             //   ->on('staff')->onDelete('cascade');
            $table->double('totalamount')->nullable();
            $table->double('depositeamount')->nullable();
            $table->double('remainingamount')->nullable();
            $table->string('deposite_by')->nullable();
            $table->date('deposite_date')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('created_by', 100)->nullable();
           // $table->foreign('created_by')->references('name')->on('staff')->onUpdate('cascade');
            $table->string('modified_by', 100)->nullable();
          //  $table->foreign('modified_by')->references('username')->on('staff')->onUpdate('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
