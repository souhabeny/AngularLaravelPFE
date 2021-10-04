<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->integer('idClient')->unsigned();
            $table->integer('idArtisan')->unsigned();
            $table->timestamps();
            $table->foreign('idClient')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('idArtisan')
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
        Schema::dropIfExists('messages');
    }
}