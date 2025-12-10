<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSeeding extends Model
{
    protected $table = 'data_seedings';

    protected $fillable = [
        'data_kolam_id',
        'tanggal_penebaran',
        'jenis_benih',
        'jumlah_ikan',
        'berat_rata_rata',
        'keterangan',
    ];

    public function kolam()
    {
        return $this->belongsTo(DataKolam::class, 'data_kolam_id');
    }
}
