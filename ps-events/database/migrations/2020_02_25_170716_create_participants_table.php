<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('slot_id');
            $table->char('name', 128);
            $table->char('group', 32);
            $table->char('student_ticket', 32);
            $table->char('email', 64);
            $table->char('phone', 64)->nullable();
            $table->char('vk_link', 128)->nullable();
            $table->boolean('activated')->default(false);

            $table->timestamps();

            $table->foreign('slot_id')->references('id')->on('slots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
