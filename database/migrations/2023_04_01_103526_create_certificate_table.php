<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificate', function (Blueprint $table) {
            $table->id();
            $table->string('principal')->index()->nullable();
            $table->string('principal_sig')->index()->nullable();
            $table->string('chairman')->index()->nullable();
            $table->string('chairman_sig')->index()->nullable();
            $table->string('secretary')->index()->nullable();
            $table->string('secretary_sig')->index()->nullable();
            $table->string('hr')->index()->nullable();
            $table->string('hr_sig')->index()->nullable();
            $table->string('seal')->index()->nullable();
            $table->string('conference_date')->index()->nullable();
            $table->longText('template')->index()->nullable();
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
        Schema::dropIfExists('certificate');
    }
}
