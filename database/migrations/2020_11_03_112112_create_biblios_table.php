<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biblios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->nullable(); 
            $table->string('file')->nullable(); 
            $table->unsignedBigInteger('emplacement_id')->nullable(); 
            $table->foreign('emplacement_id')->references('id')->on('biblio_emplacements')->onDelete('restrict');
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
        Schema::dropIfExists('biblios');
    }
}
