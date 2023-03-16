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
        Schema::create('type_chaussures', function (Blueprint $table) {
            $table->id("id_type");
             //clé étrangère pour les chaussures
             $table->foreignId('id_chaussure')->constrained('chaussures', 'id_chaussure')->onDelete('cascade');
             //clé étrangère pour les types
             $table->foreignId('id_list_types')->constrained('list_type_chaussures', 'id_list_types')->onDelete('cascade');
             //ligne que sert a interdire les doublons (par exemple: ne pas avoir deux fois  la meme chaussure et la meme taille)
            $table->unique(['id_chaussure', 'id_list_types']);
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
        Schema::dropIfExists('type_chaussures');
    }
};
