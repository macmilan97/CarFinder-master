<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('expert_id');
            $table->string('image')->nullable();
            $table->integer('experience')->nullable();
            $table->text('schedule')->nullable();
            $table->integer('departure')->nullable();
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
        Schema::dropIfExists('expert_profiles');
    }
}
