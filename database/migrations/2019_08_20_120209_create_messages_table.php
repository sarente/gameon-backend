<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message');
            $table->integer('message_type');

            //$table->string('status')->nullable();
            //$table->integer('order')->nullable();
            //$table->string('screen')->nullable();
            //$table->string('action')->nullable();
            //$table->text('short_message')->nullable();

            //event_id foreign key
            $table->timestamps();
        });
        Schema::create('message_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('message');
            $table->string('locale')->index();
            $table->timestamps();

            $table->bigInteger('message_id')->unsigned();
            $table->foreign('message_id')
                ->references('id')
                ->on('messages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['message_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
