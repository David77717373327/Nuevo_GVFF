<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementDetailPlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movement_detail_plants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plant_inventory_id')->constrained()->onDelete('cascade');
            $table->foreignId('movement_id')->constrained()->onDelete('cascade');
            $table->integer('amount')->default(0);
            $table->integer('price')->default(0);
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
        Schema::dropIfExists('movement_detail_plants');
    }
}
