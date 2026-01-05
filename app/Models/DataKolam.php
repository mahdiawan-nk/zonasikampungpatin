<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DataKolam extends Model
{
    use HasFactory;

    protected $table = 'data_kolams';

    protected $fillable = [
        'nama_kolam',
        'panjang',
        'lebar',
        'kedalaman',
        'kapasitas',
        'status',
        'feature_id',
        'polygon',
        'cordinate',
        'user_id',
    ];

    protected $casts = [
        'polygon' => 'array',
        'cordinate' => 'array',
    ];

    /**
     * Relasi ke User (Many to One)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query)
    {
        if (auth()->check() && !auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public function seedings()
    {
        return $this->hasMany(DataSeeding::class, 'data_kolam_id', 'id');
    }
}
