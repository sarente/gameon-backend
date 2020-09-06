<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransitionsTable extends Migration
{
    /**
     * Used as workflows config
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            //It could be Activity
            $table->bigInteger('from_support_id')->unsigned();
            $table->foreign('from_support_id')
                ->references('id')
                ->on('supports')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('to_support_id')->unsigned();
            $table->foreign('to_support_id')
                ->references('id')
                ->on('supports')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('workflow_id')->unsigned();
            $table->foreign('workflow_id')
                ->references('id')
                ->on('workflows')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('transitions');
    }
}
