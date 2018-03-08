<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriterionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',144);
            $table->string('title',45);
            $table->integer('percent')->nullable();
            $table->integer('effort')->nullable();
            $table->integer('sequence');
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
        Schema::dropIfExists('criterions');
    }
}
