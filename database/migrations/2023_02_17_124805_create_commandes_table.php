<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table Commandes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id("id_commande");
            //clé étrangère pour les utilisateurs
            $table->foreignId('id_utilisateur')->constrained('users', 'id_utilisateur')->onDelete('cascade');
            //clé étrangère pour les stocks de chaussures
            $table->foreignId('id_stock')->constrained('stocks', 'id_stock')->onDelete('cascade');
            // numero commande
            $table->integer('numero_commande');
            // total payeé
            $table->decimal('montant', 10, 2)->default(0.00);
            //clé étrangère pour les chaussures
            $table->foreignId('id_chaussure')->constrained('chaussures', 'id_chaussure')->onDelete('cascade')->unique();
            //clé étrangère pour les adresses
            $table->foreignId('id_adresse')->constrained('adresses', 'id_adresse')->onDelete('cascade');
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
        Schema::dropIfExists('commandes');
    }
};
