<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id');
            $table->foreignId('child_id');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories');
            $table->foreign('child_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_categories');
    }
}
