<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table Panier
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->id("id_panier");
            //clé étrangère pour les utilisateurs
            $table->foreignId('id_utilisateur')->constrained('users', 'id_utilisateur')->onDelete('cascade');
            //clé étrangère pour les stocks de chaussures
            $table->foreignId('id_stock')->constrained('stocks', 'id_stock')->onDelete('cascade');
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
        Schema::dropIfExists('paniers');
    }
};
