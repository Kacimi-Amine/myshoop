<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariableProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variable_produits', function (Blueprint $table) {
            $table->id();
            $table->string('type'); //color or taille
            //if color 
            $table->string('colorval')->nullable();
            //
            $table->string('value');
            $table->integer('produit_id')->constrained('produits')->onDelete('cascade');
            $table->float('prix_initial');
            $table->float('prix_redution');
            $table->float('prix_achat')->nullable();
            $table->integer('quantite')->nullable();
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
        Schema::dropIfExists('variable_produits');
    }
}