<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatistikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistik',function(Blueprint $table){
            $table->increments('id');
            $table->integer('mitra_id')->unsigned();
            $table->integer('kegiatan_id')->unsigned();
            $table->integer('value');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('mitra_id')->references('id')->on('mitra')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade')->onUpdate('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('statistik');
    }
}
