<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConstellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constellations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');                     // 當天日期
            $table->string('name');                     // 星座名
            $table->text('overall_fortune');            // 整體運勢
            $table->text('love_fortune');               // 愛情運勢
            $table->text('career_fortune');             // 事業運勢
            $table->text('wealth_fortune');             // 財運運勢
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
        Schema::dropIfExists('constellations');
    }
}
