<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->json('items')->default("{\"Hair\":0,\"Hat\":-1,\"TShirt\":0,\"Pants\":0,\"Shoes\":0,\"Accessory\":-1,\"SkinColor\":{\"r\":0.8679245114326477,\"g\":0.5573326945304871,\"b\":0.4544321298599243,\"a\":1.0},\"EyeColor\":{\"r\":0.22588101029396058,\"g\":0.2618088126182556,\"b\":0.3396225571632385,\"a\":0.0},\"HairColor\":{\"r\":0.9058823585510254,\"g\":0.6941176652908325,\"b\":0.0,\"a\":1.0},\"UnderpantsColor\":{\"r\":0.0,\"g\":0.0,\"b\":0.0,\"a\":0.0}} ");

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
        Schema::dropIfExists('avatars');
    }
}
