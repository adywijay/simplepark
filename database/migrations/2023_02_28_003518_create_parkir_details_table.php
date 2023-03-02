<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkirDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkir_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parkir_id');
            $table->bigInteger('biaya_total');
            $table->timestamps();

            $table->foreign('parkir_id')->references('id')->on('parkirs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parkir_details');
    }
}