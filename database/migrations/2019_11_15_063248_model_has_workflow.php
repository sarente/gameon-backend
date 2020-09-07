<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModelHasWorkflow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_workflow', function (Blueprint $table) {

            $table->string('model_type',100);
            $table->unsignedBigInteger('model_id');
            $table->index('model_id', 'model_type');

            $table->bigInteger('workflow_id')->unsigned();
            $table->foreign('workflow_id')
                ->references('id')
                ->on('workflows')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['workflow_id', 'model_id', 'model_type'],
                'model_has_workflow_workflow_model_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_workflow');
    }
}
