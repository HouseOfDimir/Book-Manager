<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jeux extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Jeux', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 100);
            $table->string('age', 100);
            $table->string('type', 100);
            $table->char('dateDebut', 8);
            $table->char('dateFin', 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Jeux');
    }
}