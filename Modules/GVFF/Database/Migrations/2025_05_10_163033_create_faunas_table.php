<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faunas', function (Blueprint $table) {
            $table->id();
            $table->string('scientific_name', 255);
            $table->string('common_name', 255);
            $table->string('habitat', 255)->nullable();
            $table->text('diet')->nullable();
            $table->enum('status', ['stable', 'critical', 'extinct']);
            $table->string('location', 255)->nullable();
            $table->string('image', 255)->nullable();
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
        Schema::dropIfExists('faunas');
    }
}
