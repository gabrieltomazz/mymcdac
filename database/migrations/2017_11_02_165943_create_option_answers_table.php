<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('answer',45);
            $table->boolean('neutral')->default(false);
            $table->boolean('good')->default(false);

            $table->timestamps();
        
            $table->integer('scale_id')->unsigned()->nullable();
            $table->foreign('scale_id')->references('id')->on('scales')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_answers');
    }
}
