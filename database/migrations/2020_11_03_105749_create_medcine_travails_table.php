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
            $table->string('visite_periodique')->nullable();
            $table->string('radiographie')->nullable();
            $table->string('examen_bio')->nullable();
            $table->string('observation')->nullable();
            $table->string('affectation')->nullable();
            $table->string('trimestre')->nullable();
            $table->string('semestre')->nullable();
            // $table->unsignedBigInteger('unite_id')->nullable();
            // $table->foreign('unite_id')->references('id')->on('unites')->onDelete('restrict');
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
        Schema::dropIfExists('medcine_travails');
    }
}
