<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilanSemestrielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilan_semestriels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('annee')->nullable();
            $table->string('semestre')->nullable();
            $table->integer('unite')->nullable(); // 1->targa; 2->hennaya
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
        Schema::dropIfExists('bilan_semestriels');
    }
}
