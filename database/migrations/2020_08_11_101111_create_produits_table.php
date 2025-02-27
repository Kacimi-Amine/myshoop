<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slugon')->unique();
            $table->text('description');
            $table->string('type');
            $table->string('sous_category');
            $table->float('prix_initial')->nullable();
            $table->float('prix_redution')->nullable();
            $table->float('prix_achat')->nullable();;
            $table->integer('quantite')->nullable();;
            $table->integer('etat')->default('0'); // affichable ou non ;;;
            $table->integer('countdown')->default('0');; //countdown activer or not 
             
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
        Schema::dropIfExists('produits');
    }
}
