<?php

namespace Modules\GVFF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\Movement;

class MovementDetailPlant extends Model
{
    use HasFactory;

    protected $fillable = ['plant_inventory_id', 'movement_id', 'amount', 'price'];
    
    protected static function newFactory()
    {
        return \Modules\GVFF\Database\factories\MovementDetailPlantFactory::new();
    }

    public function plant_inventory()
    {
        return $this->belongsTo(PlantInventory::class, 'plant_inventory_id');
    }
    
    public function movement()
    {
        return $this->belongsTo(Movement::class, 'movement_id');
    }
}
