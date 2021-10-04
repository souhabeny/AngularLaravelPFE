<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->increments('id');
            $table->float('prixpropose', 8, 3)->nullable();
            $table->integer('qte')->nullable(); 
            $table->integer('idUser')->unsigned();
            $table->integer('idProduit')->unsigned();
            $table->string('reponse')->nullable();
            $table->json('couleurSouhaite');
            $table->json('qtecouleur');
            $table->foreign('idUser')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('idProduit')
            ->references('id')
            ->on('produits')
            ->onDelete('cascade');
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
        Schema::dropIfExists('_devis');
    }
}