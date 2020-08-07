<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModelHasMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_messages', function (Blueprint $table) {

            $table->string('model_type',100);
            $table->unsignedBigInteger('model_id');
            $table->index('model_id', 'model_type');

            $table->bigInteger('message_id')->unsigned();
            $table->foreign('message_id')
                ->references('id')
                ->on('messages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['message_id', 'model_id', 'model_type'],
                'model_has_messages_message_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_messages');
    }
}
