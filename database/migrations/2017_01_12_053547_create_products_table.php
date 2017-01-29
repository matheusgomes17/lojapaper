<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('catalog.products_table'), function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('code');
            $table->string('cover');
            $table->text('description');
            $table->tinyInteger('status')->default(1)->unsigned();
            /**
             * Add Foreign/Unique/Index
             */
            $table->foreign('category_id')
                ->references('id')
                ->on(config('catalog.categories_table'));
            $table->foreign('user_id')
                ->references('id')
                ->on(config('catalog.users_table'))
                ->onDelete('cascade');

            $table->index('user_id', 'category_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('catalog.products_table'));
    }
}
