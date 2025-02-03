<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->string('main_title',191)->nullable();
            $table->string('title',191)->nullable();
            $table->string('image',191)->nullable();
            $table->longText('description')->nullable();
            $table->date('festival_date')->nullable();
            $table->double('fee_amount')->default(0);
            $table->date('registration_last_date')->nullable();
            $table->string('contact',191)->nullable();
            $table->boolean('status')->default(true);
            $table->softDeletes();
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
        Schema::dropIfExists('festivals');
    }
}
