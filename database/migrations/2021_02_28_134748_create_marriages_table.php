<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarriagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marriages', function (Blueprint $table) {
            $table->id();
            $table->integer('book_start', 5)->unsigned()->nullable();
            $table->integer('book_end', 5)->unsigned()->nullable();
            $table->date('date');
            $table->string('husband_name', 75);
            $table->integer('husband_age')->unsigned();
            $table->string('husband_father', 75)->nullable();
            $table->string('husband_mother', 75)->nullable();
            $table->string('husband_birthplace', 255)->nullable();
            $table->string('husband_address', 255)->nullable();
            $table->string('wife_name', 75);
            $table->integer('wife_age')->unsigned();
            $table->string('wife_father', 75)->nullable();
            $table->string('wife_mother', 75)->nullable();
            $table->string('wife_address', 255)->nullable();
            $table->string('wife_birthplace', 255)->nullable();
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
        Schema::dropIfExists('marriages');
    }
}
