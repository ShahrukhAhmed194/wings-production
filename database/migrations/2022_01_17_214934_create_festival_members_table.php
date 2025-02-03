<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('festival_id')->references('id')->on('festivals')->onDelete('cascade');
            $table->string('name',191)->nullable();
            $table->string('nick_name',191)->nullable();
            $table->string('father_name',191)->nullable();
            $table->string('mother_name',191)->nullable();
            $table->string('email',191)->nullable();
            $table->string('phone_number',60)->nullable();
            $table->string('session',100)->nullable();
            $table->string('gender',20)->nullable();
            $table->string('blood_group',20)->nullable();
            $table->text('address')->nullable();
            $table->string('t_shirt',20)->nullable();
            $table->string('organization_name',191)->nullable();
            $table->string('designation',191)->nullable();
            $table->string('organization_phone',191)->nullable();
            $table->text('organization_address')->nullable();
            $table->unsignedInteger('number_of_person')->default(1);
            $table->double('fee_amount')->default(0);
            $table->double('payable_amount')->default(0);
            $table->string('payment_type',100)->default(0);
            $table->string('transaction_no',191)->default(0);
            $table->boolean('is_paid')->default(false);
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
        Schema::dropIfExists('festival_members');
    }
}
