<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlantInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plant_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('productive_unit_warehouse_id')->constrained()->onDelete('cascade');
            $table->foreignId('plant_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('amount')->default(0);
            $table->integer('price')->default(0);
            $table->integer('stock')->default(0);
            $table->date('production_date')->nullable();
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
        Schema::dropIfExists('plant_inventories');
    }
}
