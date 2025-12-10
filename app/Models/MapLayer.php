<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapLayer extends Model
{
    protected $table = 'map_layers';

    protected $fillable = [
        'layer_id',
        'layer_name',
        'layer_type',
        'source_name',
        'source_layer',
        'paint',
    ];

    protected $casts = [
        'paint' => 'array',
    ];

    /**
     * Relasi ke MapFeature (One to Many)
     */
    public function features()
    {
        return $this->hasMany(MapFeature::class, 'layer_id', 'id');
    }
}
