<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150);
            $table->string('slug',150)->unique();
            $table->boolean('status')->default(1);
            $table->string('created_by', 100)->nullable();
          //  $table->foreign('created_by')->references('name')->on('staff')->onUpdate('cascade');
            $table->string('modified_by', 100)->nullable();
         //   $table->foreign('modified_by')->references('name')->on('staff')->onUpdate('cascade');
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
        Schema::dropIfExists('productcategories');
    }
}
