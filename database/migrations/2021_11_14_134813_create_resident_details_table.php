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
            $table->bigInteger('usersResident_id')->unsigned()->unique();
            $table->string('pin');
            $table->string('security_question_1');
            $table->string('security_answer_1');
            $table->string('security_question_2');
            $table->string('security_answer_2');
            $table->string('security_question_3');
            $table->string('security_answer_3');
            $table->timestamps();

            $table->foreign('usersResident_id')
            ->references('id') 
            ->on('users')
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
