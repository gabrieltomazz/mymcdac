<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objetivo_pesquisa',144);
            $table->string('objeto_pesquisa',144);
            $table->string('desempenho',55);
            $table->string('data_inicio',14);
            $table->string('data_fim',14);
            $table->integer('steps');
            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
       Schema::dropIfExists('projects');

    }
}
