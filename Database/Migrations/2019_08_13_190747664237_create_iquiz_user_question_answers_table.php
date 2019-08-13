<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIquizUserQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iquiz__user_question_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            // Your fields
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');

            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('iquiz__questions')->onDelete('restrict');

            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')->references('id')->on('iquiz__answers')->onDelete('restrict');

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
        Schema::dropIfExists('iquiz__userquestionanswers');
    }
}
