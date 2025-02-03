<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('mobile_number')->nullable();
            $table->string('password');
            $table->string('token');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('pre_users');
    }
}
