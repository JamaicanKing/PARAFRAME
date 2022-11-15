<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreetsTable extends Migration   // <---- Shouldn't this change to 'CreateAddressesTable'??? 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_communities')->unsigned();
            $table->string('name');
            $table->timestamps('');
           
            $table->foreign('id_communities')
            ->references('id')
            ->on('communities')
            ->onUpdate('cascade')
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
        Schema::dropIfExists('streets');
    }
}
