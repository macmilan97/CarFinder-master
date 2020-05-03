<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('expert_id');
            $table->string('filepath');
            $table->string('filename');
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'REVIEW'])->default('REVIEW');
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
        Schema::dropIfExists('expert_documents');
    }
}
