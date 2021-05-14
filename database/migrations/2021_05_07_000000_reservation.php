<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Reservation', function (Blueprint $table) {
            $table->id();
            $table->integer('fkLivre');
            $table->integer('fkUser');
            $table->char('dateDebut', 8);
            $table->char('dateFin', 8)->nullable();
            $table->char('dateRendu', 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Reservation');
    }
}