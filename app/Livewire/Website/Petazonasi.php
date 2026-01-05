<?php

namespace App\Livewire\Website;

use Livewire\Component;

use App\Models\DataKolam;
use App\Models\MapLayer;
use App\Models\MapFeature;
use Livewire\Attributes\On;

class Petazonasi extends Component
{

    public $offlineLayers = [];
    public $previewKolam;

    public $showPreview = false;

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
    #[On('viewDataKolam')]
    public function previewData($feature_id, $polygon = null, $clickpoint = null)
    {
        $this->showPreview = true;
        $data = DataKolam::query()
            ->select([
                'id',
                'nama_kolam',
                'panjang',
                'lebar',
                'kapasitas',
                'status',
                'user_id',
                'feature_id',
            ])
            ->with([
                'user:id,name',
                'seedings:id,data_kolam_id,tanggal_penebaran,jenis_benih,jumlah_ikan',
                'seedings.estimasi:id,data_seeding_id,sgr,target_weight,estimated_days,estimated_harvest_date',
            ])
            ->where('feature_id', $feature_id)
            ->first();

        if ($data) {
            $this->previewKolam = [
                'nama' => $data->nama_kolam,
                'panjang' => $data->panjang,
                'lebar' => $data->lebar,
                'kapasitas' => $data->kapasitas,
                'status' => $data->status,
                'user' => $data->user?->name,
                'seedings' => $data->seedings->map(fn($s) => [
                    'tanggal' => $s->tanggal_penebaran,
                    'jenis' => $s->jenis_benih,
                    'jumlah' => $s->jumlah_ikan,
                    'estimasi' => $s->estimasi->map(fn($e) => [
                        'sgr' => $e->sgr,
                        'target' => $e->target_weight,
                        'hari' => $e->estimated_days,
                        'tanggal' => $e->estimated_harvest_date,
                    ]),
                ])->values(),
            ];
        } else {
            $this->previewKolam = null;
        }

        $this->dispatch('loadingHide', $this->previewKolam);

    }

    public function render()
    {
        return view('livewire.website.petazonasi');
    }
}
