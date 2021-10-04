<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qtecommande');
            $table->string('adresselivraison');
            $table->integer('idCommande')->unsigned(); 
            $table->integer('idProduit')->unsigned();
            $table->timestamps();

            $table->foreign('idCommande')
            ->references('id')
            ->on('commandes')
            ->onDelete('cascade');
            $table->foreign('idProduit')
            ->references('id')
            ->on('produits')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_commandes');
    }
}