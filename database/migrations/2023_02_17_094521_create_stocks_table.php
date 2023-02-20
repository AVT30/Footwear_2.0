<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id("id_stock");
            //clé étrangère pour les chaussures
            $table->foreignId('id_chaussure')->constrained('chaussures', 'id_chaussure')->onDelete('cascade')->unique();
            //clé étrangère pour les chaussures
            $table->foreignId('id_taille')->constrained('tailles', 'id_taille')->onDelete('cascade')->unique();
            $table->integer("stock")->default(50);
            $table->timestamps();
            //ligne que sert a interdire les doublons (par exemple: ne pas avoir deux fois  la meme chaussure et la meme taille)
            $table->unique(['id_chaussure', 'id_taille']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
