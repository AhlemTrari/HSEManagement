<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentParHeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident_par_heurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('heure')->nullable();
            $table->integer('nbr_accidents')->nullable();
            $table->unsignedBigInteger('bilan_id')->nullable();
            $table->foreign('bilan_id')->references('id')->on('bilan_mensuels')->onDelete('restrict');
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
        Schema::dropIfExists('accident_par_heurs');
    }
}
