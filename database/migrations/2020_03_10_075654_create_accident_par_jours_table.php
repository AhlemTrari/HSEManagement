<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentParJoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident_par_jours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jour')->nullable();
            $table->integer('avec_arret')->nullable();
            $table->integer('sans_arret')->nullable();
            $table->integer('bilan_id')->nullable();
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
        Schema::dropIfExists('accident_par_jours');
    }
}
