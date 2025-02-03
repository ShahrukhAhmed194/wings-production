<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->bigInteger('member_id')->nullable(); // Create id after payment
            $table->string('member_id_string')->nullable(); // Create id after payment
            $table->string('type', 55)->default('member'); // member, admin
            $table->unsignedBigInteger('member_type_id')->nullable();
            $table->string('status', 55)->default('pending'); // pending, canceled, approved, before_submit
            $table->string('payment_status', 55)->default('unpaid'); // unpaid, paid

            // Personal Information
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('bengali_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('email', 191)->unique();
            $table->string('username', 191)->nullable()->unique();
            $table->string('mobile_number')->nullable();
            $table->string('n_id',50)->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('father_name',191)->nullable();
            $table->string('mother_name',191)->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->timestamp('spouse_dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('profile_image')->nullable();

            // University Information
            $table->string('academic_session',100)->nullable();
            $table->string('department')->nullable();
            $table->string('hall')->nullable();

            // Mailing Address
            $table->string('mailing_address')->nullable();
            $table->string('mailing_city')->nullable();
            $table->string('mailing_district')->nullable();
            $table->string('mailing_post_code')->nullable();
            $table->string('mailing_country')->nullable();
            $table->string('contact_no_res')->nullable();

            // Permanent Address
            $table->string('permanent_address')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_post_code')->nullable();
            $table->string('permanent_country')->nullable();

            // Organization Details
            $table->string('organization')->nullable();
            $table->string('organization_designation')->nullable();
            $table->string('organization_phone')->nullable();
            $table->string('organization_address')->nullable();

            // Others
            $table->longText('address')->nullable(); // Json data
            $table->string('password');
            $table->string('payment_method')->nullable();
            $table->string('payment_trx_number')->nullable();
            $table->text('update_note')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
