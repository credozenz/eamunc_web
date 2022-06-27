<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->comment('0->ISG Student,2->School Student');
            $table->integer('user_id')->index();
            $table->integer('school_id');
            $table->string('name')->index();
            $table->string('email')->index();
            $table->string('class');
            $table->string('phone_code')->index()->nullable();
            $table->string('whatsapp_no')->index()->nullable();
            $table->string('mun_experience')->nullable();
            $table->string('bureaumem_experience')->nullable();
            $table->string('awards_received')->nullable();
            $table->string('committee_choice')->nullable();
            $table->string('country_choice')->nullable();
            $table->string('position')->nullable();
            $table->string('liability_form')->nullable();
            $table->integer('status')->comment('0->pending,1->approve,2->invite,3->active,4->reject')->default(0);
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
        Schema::dropIfExists('students');
    }
}
