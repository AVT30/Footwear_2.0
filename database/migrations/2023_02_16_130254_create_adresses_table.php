<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table Adresse
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adresses', function (Blueprint $table) {
            $table->id("id_adresse");
            $table->string('adresse');
            $table->integer('code_postal');
            $table->string('ville');
            //clé étrangère pour les pays
            $table->foreignId('id_pays')->constrained('pays', 'id_pays')->onDelete('cascade');
            //clé étrangère pour les utilisateurs
            $table->foreignId('id_utilisateur')->constrained('utilisateurs', 'id_utilisateur')->onDelete('cascade');
            $table->boolean('type_adresse');
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
        Schema::dropIfExists('adresses');
    }
};
