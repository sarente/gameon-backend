<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanesTable extends Migration
{
    /**
     * template > panes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level_no')->default(0);
            $table->integer('pane_no')->default(0);

            $table->bigInteger('template_id')->unsigned();
            $table->foreign('template_id')
                ->references('id')
                ->on('templates')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('panes');
    }
}
