<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryPane extends Migration
{
    /**
     * Connect category to templates panes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_pane', function (Blueprint $table) {

            $table->bigInteger('id')->autoIncrement();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('pane_id')->unsigned()->nullable();
            $table->foreign('pane_id')
                ->references('id')
                ->on('panes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
            //FIXME: User could be add to this table
            //we have to add user_template
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_pane');
    }
}
