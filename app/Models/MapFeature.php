<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapFeature extends Model
{
    protected $table = 'map_features';

    protected $fillable = [
        'layer_id',
        'feature_id',
        'geometry_type',
        'coordinates',
        'properties',
        'hash',
    ];

    protected $casts = [
        'coordinates' => 'array',
        'properties' => 'array',
    ];

    /**
     * Relasi ke MapLayer (Many to One)
     */
    public function layer()
    {
        return $this->belongsTo(MapLayer::class, 'layer_id', 'id');
    }
}
