<?php

namespace Modules\GVFF\Entities;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    protected $table = 'inventory_tools'; 
}

