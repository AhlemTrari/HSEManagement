<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilanAnnuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilan_annuels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('annee')->nullable();
            $table->integer('unite')->nullable(); // 1->targa; 2->hennaya
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
        Schema::dropIfExists('bilan_annuels');
    }
}
