<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitteeMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('committee_id')->constrained()->onDelete('cascade');
            $table->string('designation');
            $table->integer('position')->default(1000);
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
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
        Schema::dropIfExists('committee_members');
    }
}
