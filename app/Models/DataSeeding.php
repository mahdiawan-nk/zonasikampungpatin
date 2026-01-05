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
        return $this->belongsTo(DataKolam::class, 'data_kolam_id')->forUser();
    }

    public function scopeForUser($query, $user)
    {
        if ($user && !$user->isAdmin()) {
            $query->whereHas(
                'kolam',
                fn($q) => $q->where('user_id', $user->id)
            );
        }
    }

    public function estimasi()
    {
        return $this->hasMany(DataEstimasiPanen::class, 'data_seeding_id', 'id');
    }

}
