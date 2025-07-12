<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_tools', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->string('status')->default('DISPONIBLE'); // DISPONIBLE, OCUPADA, DAÑADA, etc.
    $table->boolean('available')->default(true); // Indica si la herramienta está disponible para uso
    $table->date('acquisition_date')->nullable(); // Fecha de adquisición de la herramienta
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
        Schema::dropIfExists('inventory_tools');
    }
}
