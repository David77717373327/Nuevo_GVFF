<?php

namespace Modules\GVFF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SICA\Entities\ProductiveUnitWarehouse;

class PlantInventory extends Model
{
    use HasFactory;

    protected $fillable = ['productive_unit_warehouse_id','person_id', 'plant_id', 'amount', 'production_date','price'];
    
    protected static function newFactory()
    {
        return \Modules\GVFF\Database\factories\PlantInventoryFactory::new();
    }

    public function person()
    {
        return $this->belongsTo(\Modules\SICA\Entities\Person::class, 'person_id');
    }

    public function productive_unit_warehouse()
    {
        return $this->belongsTo(ProductiveUnitWarehouse::class);
    }
    //s
    public function plant()
    {
        return $this->belongsTo(\Modules\GVFF\Entities\Plant::class, 'plant_id');
    }

    public function movement_detail_plants()
    {
        return $this->hasMany(MovementDetailPlant::class, 'plant_inventory_id');
    }
}
