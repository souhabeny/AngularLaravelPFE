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
            $table->increments('id');
            $table->string('libelle');
            $table->string('description');
            $table->string('image');
            $table->float('prix', 8, 2);
            $table->float('promo', 8, 2)->default('000.0');
            $table->json('couleur');
            $table->integer('idCategorie')->unsigned(); 
            $table->integer('idUser')->unsigned();
            $table->timestamps();
          
            
             $table->foreign('idCategorie')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
                $table->foreign('idUser')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('produits');
    }
}