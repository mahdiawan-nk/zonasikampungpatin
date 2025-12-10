<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataEstimasiPanen extends Model
{
    protected $table = 'data_estimasi_panens';

    protected $fillable = [
        'data_seeding_id',
        'sgr',
        'target_weight',
        'estimated_days',
        'estimated_harvest_date',
        'notes',
    ];

    public function dataSeeding()
    {
        return $this->belongsTo(DataSeeding::class, 'data_seeding_id');
    }
}
