<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('line')->nullable();
            $table->integer('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
            $table->integer('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->integer('role_id')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
            $table->integer('created_by')->nullable();
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
