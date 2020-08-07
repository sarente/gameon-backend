<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelHasReward extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_rewards', function (Blueprint $table) {

            $table->string('model_type',100);
            $table->unsignedBigInteger('model_id');
            $table->index('model_id', 'model_type');

            $table->bigInteger('reward_id')->unsigned();
            $table->foreign('reward_id')
                ->references('id')
                ->on('rewards')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['reward_id', 'model_id', 'model_type'],
                'model_has_rewards_reward_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_rewards');
    }
}
