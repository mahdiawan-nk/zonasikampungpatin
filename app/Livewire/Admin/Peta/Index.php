<?php

namespace App\Livewire\Admin\Peta;

use Livewire\Component;
use App\Models\MapLayer;
use App\Models\MapFeature;
use Livewire\Attributes\On;
class Index extends Component
{
    public $paylod = [];
    public $offlineLayers = [];
    public function mount()
    {

        // $this->dispatch('mounted');
        $this->loadOfflineLayers();
    }

    public function loadOfflineLayers()
    {
        $this->offlineLayers = MapLayer::with('features')->get()->map(function ($layer) {
            return [
                'id' => $layer->layer_id,
                'type' => $layer->layer_type,
                'paint' => $layer->paint,
                'source_layer' => $layer->source_layer,
                'data' => [
                    'type' => 'FeatureCollection',
                    'features' => $layer->features->map(function ($f) {
                        return [
                            'type' => 'Feature',
                            'id' => $f->feature_id,
                            'geometry' => [
                                'type' => $f->geometry_type,
                                'coordinates' => json_decode($f->coordinates, true),
                            ],
                            'properties' => json_decode($f->properties, true),
                        ];
                    })
                ]
            ];
        })->toArray();
        // dump($this->offlineLayers);
        // Gunakan event DOM agar bisa diambil Alpine.js
        $this->dispatch('syncFinished');
        $this->dispatch('offlineLayersUpdated', layers: $this->offlineLayers);
        $this->dispatch('offlineReady', $this->offlineLayers);
    }


    #[On('petaCreated')]
    public function store($payload)
    {
        // dump($payload);
        foreach ($payload as $layerData) {
            $layer = MapLayer::updateOrCreate(
                ['layer_id' => $layerData['layer_id']],
                [
                    'layer_name' => $layerData['layer_name'],
                    'layer_type' => $layerData['layer_type'],
                    'source_name' => $layerData['source_name'],
                    'source_layer' => $layerData['source_layer'],
                    'paint' => json_encode($layerData['paint']),
                ]
            );

            $existing = MapFeature::where('layer_id', $layer->id)
                ->get()
                ->keyBy('feature_id');

            $newId = [];

            foreach ($layerData['features']['features'] as $f) {
                $hash = md5(json_encode([
                    'geometry' => $f['geometry'],
                    'properties' => $f['properties'],
                ]));

                $newId[] = $f['id'];

                if (!$existing->has($f['id'])) {
                    MapFeature::create([
                        'layer_id' => $layer->id,
                        'feature_id' => $f['id'],
                        'geometry_type' => $f['geometry']['type'],
                        'coordinates' => json_encode($f['geometry']['coordinates']),
                        'properties' => json_encode($f['properties']),
                        'hash' => $hash,
                    ]);
                } else {
                    $feat = $existing[$f['id']];

                    if ($feat->hash !== $hash) {
                        $feat->update([
                            'geometry_type' => $f['geometry']['type'],
                            'coordinates' => json_encode($f['geometry']['coordinates']),
                            'properties' => json_encode($f['properties']),
                            'hash' => $hash,
                        ]);
                    }
                }
            }
            // Hapus fitur yang tidak ada di payload baru
            MapFeature::where('layer_id', $layer->id)
                ->whereNotIn('feature_id', $newId)
                ->delete();
        }
        $this->loadOfflineLayers();
        $this->dispatch('syncFinished');
    }

    public function render()
    {
        return view('livewire.admin.peta.index');
    }
}
