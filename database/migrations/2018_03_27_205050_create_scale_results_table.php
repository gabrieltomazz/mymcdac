<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScaleResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scale_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
            $table->boolean('median')->default(false)->nullable();

            $table->timestamps();

            $table->integer('criterion_id')->unsigned();
            $table->foreign('criterion_id')->references('id')->on('criterions')->onDelete('cascade');

            $table->integer('option_answer_id')->unsigned();
            $table->foreign('option_answer_id')->references('id')->on('option_answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scale_results');
    }
}
