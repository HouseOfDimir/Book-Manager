<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Livres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Livres', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100);
            $table->string('titre', 100);
            $table->string('auteur', 100);
            $table->string('genre', 100);
            $table->string('appartenance', 100);
            $table->char('etatActuel', 10);
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
        Schema::dropIfExists('Livres');
    }
}