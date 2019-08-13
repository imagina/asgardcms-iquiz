<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIquizPollTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iquiz__poll_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->string('title');
            $table->text('description')->nullable();

            $table->integer('poll_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['poll_id', 'locale']);
            $table->foreign('poll_id')->references('id')->on('iquiz__polls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iquiz__poll_translations', function (Blueprint $table) {
            $table->dropForeign(['poll_id']);
        });
        Schema::dropIfExists('iquiz__poll_translations');
    }
}
