<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualMeetingsDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_meetings_documents', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('owner_id')->unsigned()->default(0);
            $table->foreign('owner_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('title', 60);
            $table->string('filename', 60);
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
        Schema::drop('annual_meetings_documents');
    }
}
