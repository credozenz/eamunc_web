<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlumniRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni_registration', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('email')->index();
            $table->string('phone_code')->index()->nullable();
            $table->string('phone_no')->index()->nullable();
            $table->string('qualification')->nullable();
            $table->date('dob')->nullable();
            $table->string('portfolio')->nullable();
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
        Schema::dropIfExists('alumni_registration');
    }
}
