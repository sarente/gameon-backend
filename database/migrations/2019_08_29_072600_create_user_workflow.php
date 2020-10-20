<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWorkflow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_workflow', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->bigInteger('workflow_id')->unsigned();
            $table->foreign('workflow_id')
                ->references('id')
                ->on('workflows')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('enable')->default(false);
            $table->json('current_place')->nullable();
            $table->string('marking')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['workflow_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_workflow');
    }
}
