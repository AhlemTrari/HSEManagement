<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclarationAccidentTravailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declaration_accident_travails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num')->nullable();
            $table->integer('unite')->nullable(); // 1->targa; 2->hennaya
            $table->boolean('autre_victimes')->nullable();
            $table->string('chantier')->nullable();
            $table->string('lieu')->nullable();
            $table->string('date')->nullable();
            $table->string('heure')->nullable();
            $table->string('travail_courrant')->nullable();
            $table->string('nature_lesion')->nullable();
            $table->string('siege_lesion')->nullable();
            $table->string('materiel')->nullable();
            $table->string('cause_direct')->nullable();
            $table->string('cause_indirect')->nullable();
            $table->string('consequences')->nullable();
            $table->integer('nbr_arret')->nullable();
            $table->string('transporter_a')->nullable();
            $table->string('moyen_par')->nullable();
            $table->string('temoins')->nullable();
            $table->string('circonstances_detaillees')->nullable();
            $table->unsignedBigInteger('unite_id')->nullable();
            $table->foreign('unite_id')->references('id')->on('unites')->onDelete('restrict');
            $table->unsignedBigInteger('tiers_id')->nullable();
            $table->unsignedBigInteger('employe_id')->nullable();
            $table->foreign('tiers_id')->references('id')->on('employes')->onDelete('restrict');
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
        Schema::dropIfExists('declaration_accident_travails');
    }
}
