<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficialCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('official_communities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_communities')->unsigned();
            $table->string('name_official');
            $table->string('phone_number');
            $table->string('email');
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
        Schema::dropIfExists('official_communities');
    }
}
