<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilanTrimestrielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilan_trimestriels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('annee')->nullable();
            $table->string('trimestre')->nullable();
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
        Schema::dropIfExists('bilan_trimestriels');
    }
}
