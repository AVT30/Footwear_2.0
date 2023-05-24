<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table Chaussure
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chaussures', function (Blueprint $table) {
            $table->id('id_chaussure');
            $table->string('modele');
            $table->string('marque');
            $table->string('genre');
            //clé étrangère pour les types
            $table->foreignId('id_list_types')->constrained('list_type_chaussures', 'id_list_types');
            $table->string('couleurP');
            $table->string('couleurS');
            $table->double('prix');

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
        Schema::dropIfExists('chaussures');
    }
};
