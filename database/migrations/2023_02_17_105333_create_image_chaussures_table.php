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
        Schema::create('image_chaussures', function (Blueprint $table) {
            $table->id('id_image_chaussure');
            $table->string('image_chaussure')->unique();
            //clé étrangère pour les chaussures
            $table->foreignId('id_chaussure')->constrained('chaussures', 'id_chaussure')->onDelete('cascade');
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
        Schema::dropIfExists('image_chaussures');
    }
};
