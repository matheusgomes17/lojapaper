<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('catalog.categories_table'), function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('_lft')->unsigned();
            $table->integer('_rgt')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('description');
            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('user_id')
                ->references('id')
                ->on(config('catalog.users_table'));
            $table->index(['_lft', '_rgt', 'parent_id']);
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
        Schema::dropIfExists(config('catalog.categories_table'));
    }
}
