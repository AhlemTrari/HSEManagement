<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentParSiegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident_par_sieges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siege_lesions')->nullable();
            $table->integer('nbr_accidents')->nullable();
            $table->integer('bilan_id')->nullable();
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
        Schema::dropIfExists('accident_par_sieges');
    }
}
