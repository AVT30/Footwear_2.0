<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table Rabais
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rabais', function (Blueprint $table) {
            $table->id("id_rabais");
            //rabais de 10% a 80%
            //clé étrangère pour les chaussures
            $table->foreignId('id_chaussure')->constrained('chaussures', 'id_chaussure')->onDelete('cascade')->unique();
            $table->integer("rabais")->default(0);
            $table->date('expiration_rabais');

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
        Schema::dropIfExists('rabais');
    }
};
