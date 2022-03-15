<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_delegates', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('school_id');
            $table->string('name');
            $table->string('email');
            $table->string('class');
            $table->string('whatsapp_no');
            $table->string('mun_experience');
            $table->string('bureaumem_experience');
            $table->integer('status')->comment('0->pending,1->active,2->reject')->default(0);
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
        Schema::dropIfExists('school_delegates');
    }
}
