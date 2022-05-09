<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('thread_id');
            $table->unsignedBigInteger('category_id');

            //Set up unique key
            $table->unique(['thread_id', 'category_id']);

            //Fk
            $table->foreign('thread_id')
                ->references('id')
                ->on('threads')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_threads');
    }
}
