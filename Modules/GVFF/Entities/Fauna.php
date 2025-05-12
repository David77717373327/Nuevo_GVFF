<?php

namespace Modules\GVFF\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fauna extends Model
{
    use HasFactory;

    protected $table = 'faunas';

    protected $fillable = [
        'scientific_name',
        'common_name',
        'habitat',
        'diet',
        'status',
        'location',
        'image',
    ];

    protected $casts = [
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
