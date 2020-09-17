<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPoint extends Migration
{
    /**
     * user - activity - point
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_point', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('activity_id')->unsigned();
            $table->foreign('activity_id')
                ->references('id')
                ->on('activities')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('workflow_id')->unsigned()->nullable();
            $table->foreign('workflow_id')
                ->references('id')
                ->on('workflows')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('point')->default(0);
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
        Schema::dropIfExists('user_point');
    }
}
