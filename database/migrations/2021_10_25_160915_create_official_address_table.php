<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_address')->unsigned();
            $table->string('name_official');
            $table->string('phone_number');
            $table->string('email');
            $table->timestamps('');
           
            $table->foreign('id_address')
            ->references('id')
            ->on('addresses')
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
        Schema::dropIfExists('official_addresses');
    }
}
