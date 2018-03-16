<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSortLastCriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sort_last_criteria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order');
            $table->timestamps();

            $table->integer('criterion_id')->unsigned()->nullable();
            $table->foreign('criterion_id')->references('id')->on('criterions')->onDelete('cascade');

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sort_last_criteria');
    }
}
