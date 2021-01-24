<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricule')->nullable();
            $table->string('photo')->nullable();
            $table->string('nom')->nullable();
            $table->string('fonction')->nullable();
            $table->string('statut')->nullable();
            $table->string('adresse')->nullable();
            $table->string('situation')->nullable();
            $table->integer('unite')->nullable();
            $table->string('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('date_rec')->nullable();
            $table->string('sexe')->nullable();
            $table->string('num_sociale')->nullable();
            $table->string('affectation')->nullable();
            $table->string('visite_embauche')->nullable();
            $table->string('poste_risque')->nullable();
            $table->unsignedBigInteger('unite_id')->nullable();
            $table->foreign('unite_id')->references('id')->on('unites')->onDelete('restrict');
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
        Schema::dropIfExists('employes');
    }
}
