<?php

namespace Modules\GVFF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryTool extends Model

{
    protected $fillable = ['name', 'description', 'status'];

    protected $table = 'inventory_tools'; 
}

