<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('ref');
            $table->date('date');
            $table->string('description');
            $table->bigInteger('type_id')->unsigned();
            $table->tinyInteger('paid')->default('1');
            $table->tinyInteger('posted')->default('1');
            $table->tinyInteger('approved')->default('1');
            $table->tinyInteger('enabled')->default('1');
            $table->foreign('type_id')->references('id')->on('document_types');
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
        Schema::dropIfExists('documents');
    }
}
