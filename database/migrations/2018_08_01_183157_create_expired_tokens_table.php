<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpiredTokensTable extends Migration
{
    /**
     * template > panes > level_images
     * Selected template define number of levels in application
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expired_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('jwt_token');
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
        Schema::drop('expired_tokens');
    }
}
