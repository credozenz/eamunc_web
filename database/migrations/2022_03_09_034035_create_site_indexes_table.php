<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteIndexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_indexes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('post')->nullable();
            $table->string('video')->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->integer('status')->comment('0=>archive,1=>active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_indexes');
    }
}
