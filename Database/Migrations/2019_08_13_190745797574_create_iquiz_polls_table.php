<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIquizPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iquiz__polls', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('logged')->default(false)->unsigned();
            $table->tinyInteger('status')->default(1)->unsigned();

            $table->integer('store_id')->unsigned()->nullable();

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
        Schema::dropIfExists('iquiz__polls');
    }
}
