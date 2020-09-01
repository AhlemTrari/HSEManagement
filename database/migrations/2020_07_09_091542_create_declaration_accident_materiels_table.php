<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclarationAccidentMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaration_accident_materiels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num')->nullable();
            $table->string('libelle')->nullable();
            $table->integer('unite')->nullable(); // 1->targa; 2->hennaya
            $table->boolean('autre_victimes')->nullable();
            $table->string('chantier')->nullable();
            $table->string('lieu')->nullable();
            $table->string('date')->nullable();
            $table->string('heure')->nullable();
            $table->string('travail_courrant')->nullable();
            $table->string('materiel')->nullable();
            $table->string('cause_direct')->nullable();
            $table->string('cause_indirect')->nullable();
            $table->string('consequences')->nullable();
            $table->string('tiers_nom')->nullable();
            $table->string('tiers_prenom')->nullable();
            $table->string('tiers_adress')->nullable();
            $table->string('temoins')->nullable();
            $table->string('constatation_police')->nullable();
            $table->string('circonstances_detaillees')->nullable();
            $table->integer('tiers_id')->nullable();
            $table->integer('employe_id')->nullable();
            $table->string('trimestre')->nullable();
            $table->string('semestre')->nullable();
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
        Schema::dropIfExists('declaration_accident_materiels');
    }
}
