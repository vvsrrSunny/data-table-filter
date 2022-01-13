<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price')->nullable();
            $table->integer('offices')->nullable();
            $table->integer('tables')->nullable();
            $table->float('square_meters')->nullable();
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
        Schema::dropIfExists('business_data');
    }
}
