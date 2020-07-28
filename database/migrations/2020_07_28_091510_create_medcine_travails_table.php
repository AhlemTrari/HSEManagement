<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedcineTravailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medcine_travails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num')->nullable();
            $table->integer('unite')->nullable(); // 1->targa; 2->hennaya
            $table->string('date')->nullable();
            $table->string('visite_periodique')->nullable();
            $table->string('radiographie')->nullable();
            $table->string('examen_bio')->nullable();
            $table->string('observation')->nullable();
            $table->string('affectation')->nullable();
            $table->integer('employe_id')->nullable();
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
        Schema::dropIfExists('medcine_travails');
    }
}
