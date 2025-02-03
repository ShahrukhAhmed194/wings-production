<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondGalleryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('thumbnail');
            $table->integer('position')->default(1000);
            $table->string('english_title')->nullable();
            $table->string('arabic_title')->nullable();
            $table->unsignedBigInteger('sec_gallery_category_id')->nullable();
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
        Schema::dropIfExists('second_gallery_items');
    }
}
