<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->timestamps();
        });


        Schema::create('reward_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('locale')->index();

            $table->bigInteger('reward_id')->unsigned();
            $table->foreign('reward_id')
                ->references('id')
                ->on('rewards')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['reward_id', 'locale']);
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
        Schema::dropIfExists('rewards_translations');
        Schema::dropIfExists('rewards');
    }
}
