<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilanMensuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilan_mensuels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('annee')->nullable();
            $table->string('mois')->nullable();
            $table->integer('nbr_accidents')->nullable();
            $table->integer('nbr_jours')->nullable();
            $table->integer('unite')->nullable(); // 1->targa; 2->hennaya
            $table->string('trimestre')->nullable();
            $table->string('semestre')->nullable();
            $table->unsignedBigInteger('unite_id')->nullable();
            $table->foreign('unite_id')->references('id')->on('unites')->onDelete('restrict');
            $table->unsignedBigInteger('bilan_trimestriel_id')->nullable();
            $table->foreign('bilan_trimestriel_id')->references('id')->on('bilan_trimestriels')->onDelete('restrict');
            $table->unsignedBigInteger('bilan_semestriel_id')->nullable();
            $table->foreign('bilan_semestriel_id')->references('id')->on('bilan_semestriels')->onDelete('restrict');
            $table->unsignedBigInteger('bilan_annuel_id')->nullable();
            $table->foreign('bilan_annuel_id')->references('id')->on('bilan_annuels')->onDelete('restrict');
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
        Schema::dropIfExists('bilan_mensuels');
    }
}
