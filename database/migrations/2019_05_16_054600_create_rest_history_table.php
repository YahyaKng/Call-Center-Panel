<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->integer('team_id');
            // $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->string('rest_type');
            // add break start and break end
            $table->integer('end_status')->nullable(); // cancelled / rested
            $table->timestamp('break_start')->nullable();
            $table->timestamp('end')->nullable(); // cancel / end
            $table->timestamp('duration')->nullable();
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
        Schema::dropIfExists('rest_history');
    }
}
