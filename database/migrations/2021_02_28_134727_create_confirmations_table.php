<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmations', function (Blueprint $table) {
            $table->id();
            $table->integer('book_number')->unsigned()->nullable();
            $table->integer('folio_number')->unsigned()->nullable();
            $table->integer('record_number')->unsigned()->nullable();
            $table->date('date');
            $table->string('name', 75)->nullable();
            $table->char('gender', 1)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('father_name', 75)->nullable();
            $table->string('mother_name', 75)->nullable();
            $table->string('godfather_name', 75)->nullable();
            $table->string('godmother_name', 75)->nullable();
            $table->integer('organization_id')->unsigned()->index()->default(1);
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
        Schema::dropIfExists('confirmations');
    }
}
