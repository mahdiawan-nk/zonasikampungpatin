<?php

namespace App\Livewire\Website;

use Livewire\Component;

use App\Models\DataKolam;
use App\Models\MapLayer;

class Petazonasi extends Component
{

    public $offlineLayers = [];

    public function mount()
    {
        $this->loadOfflineLayers();
    }

    public function loadOfflineLayers()
    {
        // Ambil semua feature_id kolam yang sudah disimpan
        $kolams = DataKolam::select('feature_id', 'nama_kolam')->get()
            ->keyBy('feature_id');

        $kolamsId = $kolams->keys()->toArray();

        $this->offlineLayers = MapLayer::with('features')->get()->map(function ($layer) use ($kolamsId, $kolams) {
            return [
                'id' => $layer->layer_id,
                'type' => $layer->layer_type,
                'paint' => $layer->paint,
                'source_layer' => $layer->source_layer,
                'data' => [
                    'type' => 'FeatureCollection',
                    'features' => $layer->features->map(function ($f) use ($kolamsId, $kolams) {
                        return [
                            'type' => 'Feature',
                            'id' => $f->feature_id,
                            'geometry' => [
                                'type' => $f->geometry_type,
                                'coordinates' => json_decode($f->coordinates, true),
                            ],
                            'properties' => [
                                ...json_decode($f->properties, true),
                                'name' => $kolams[$f->feature_id]->nama_kolam ?? null,
                            ]
                        ];
                    })
                ]
            ];
        })->toArray();
    }
    public function render()
    {
        return view('livewire.website.petazonasi');
    }
}
