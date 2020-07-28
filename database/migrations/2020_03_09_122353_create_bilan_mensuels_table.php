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
            $table->integer('bilan_trimestriel_id')->nullable();
            $table->integer('bilan_semestriel_id')->nullable();
            $table->integer('bilan_annuel_id')->nullable();
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
