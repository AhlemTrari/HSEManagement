<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('employe_id')->nullable();
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('restrict');
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
        Schema::dropIfExists('inductions');
    }
}
