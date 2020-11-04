<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('intitule')->nullable();
            $table->integer('unite')->nullable();
            $table->string('date')->nullable();
            $table->integer('reunions_chs')->nullable();
            $table->integer('reunions_extra')->nullable();
            $table->integer('nbr_enquete')->nullable();
            $table->integer('cas_recours')->nullable();
            $table->string('file1')->nullable();
            $table->string('file2')->nullable();
            $table->string('merger')->nullable();
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
        Schema::dropIfExists('commissions');
    }
}
