<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->bigInteger('address_id')->unsigned();
            $table->integer('lot_number');
            $table->integer('pin')->nullable();
            $table->string('security_question_1')->nullable();
            $table->string('security_answer_1')->nullable();
            $table->string('security_question_2')->nullable();
            $table->string('security_answer_2')->nullable();
            $table->string('security_question_3')->nullable();
            $table->string('security_answer_3')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id') 
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('address_id')
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
        Schema::dropIfExists('resident_details');
    }
}
