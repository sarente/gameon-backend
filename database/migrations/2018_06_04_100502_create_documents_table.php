<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('name');
            $table->string('size')->nullable();

            $table->string('version')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->string('original_name')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();

            $table->string('documentable_type');
            $table->string('documentable_id');
            $table->index(['documentable_type', 'documentable_id']);

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('documents');
    }
}
