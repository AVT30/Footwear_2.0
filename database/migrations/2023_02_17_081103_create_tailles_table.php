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
        Schema::create('tailles', function (Blueprint $table) {
            $table->id("id_taille");
            $table->double("taille");
            $table->timestamps();
        });
        //petit for pour ingrémenter les champs directement de 30 a 50
        for ($i = 30; $i <= 50; $i += 0.5) {
            DB::table('tailles')->insert([
                'taille' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tailles');
    }
};
