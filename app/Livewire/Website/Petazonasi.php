<?php

namespace App\Livewire\Website;

use Livewire\Component;

use App\Models\DataKolam;
use App\Models\DataSeeding;
use App\Models\MapLayer;
use App\Models\MapFeature;
use Livewire\Attributes\On;
use Carbon\Carbon;
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
        $today = Carbon::today();
        $h3Date = $today->copy()->addDays(3)->format('Y-m-d');

        // Ambil kolam
        $kolams = DataKolam::with('user')->select('id', 'feature_id', 'nama_kolam', 'kapasitas', 'user_id')
            ->get()
            ->keyBy('feature_id');

        $kolamsId = $kolams->keys()->toArray();

        /**
         * 🔥 Ambil feature_id kolam yang akan panen H-3
         */
        $kolamWillHarvestH3 = DataSeeding::query()
            ->whereRaw(
                "DATE_ADD(tanggal_penebaran, INTERVAL estimated_days DAY) = ?",
                [$h3Date]
            )
            ->whereIn('data_kolam_id', $kolams->pluck('id'))
            ->pluck('data_kolam_id')
            ->unique()
            ->toArray();

        // Mapping data_kolam_id → feature_id
        $kolamHarvestFeatureIds = DataKolam::whereIn('id', $kolamWillHarvestH3)
            ->pluck('feature_id')
            ->toArray();

        /**
         * Map ke layer geojson
         */
        $this->offlineLayers = MapLayer::with('features')->get()->map(function ($layer) use ($kolams, $kolamsId, $kolamHarvestFeatureIds) {
            return [
                'id' => $layer->layer_id,
                'type' => $layer->layer_type,
                'paint' => $layer->paint,
                'source_layer' => $layer->source_layer,
                'data' => [
                    'type' => 'FeatureCollection',
                    'features' => $layer->features->map(function ($f) use ($kolams, $kolamsId, $kolamHarvestFeatureIds) {
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
                                'kapasitas' => $kolams[$f->feature_id]->kapasitas ?? null,
                                'pemilik' => $kolams[$f->feature_id]->user->name ?? null,
                                'feature_id' => $f->feature_id,
                                'isSaved' => in_array($f->feature_id, $kolamsId),
                                'will_harvest_3_days' => in_array(
                                    $f->feature_id,
                                    $kolamHarvestFeatureIds
                                ),
                            ],
                        ];
                    }),
                ],
            ];
        })->toArray();
    }
    #[On('viewDataKolam')]
    public function previewData(string $feature_id): void
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
                'seedings' => function ($q) {
                    $q->select([
                        'id',
                        'data_kolam_id',
                        'tanggal_penebaran',
                        'jenis_benih',
                        'jumlah_ikan',
                        'estimated_days',
                        'estimated_harvest_date',
                    ])
                        ->latest('tanggal_penebaran')
                        ->limit(1);
                }
            ])
            ->where('feature_id', $feature_id)
            ->first();

        if (!$data) {
            $this->previewKolam = null;
            $this->dispatch('loadingHide', null);
            return;
        }

        $seeding = $data->seedings->first();

        $this->previewKolam = [
            'nama' => $data->nama_kolam,
            'panjang' => $data->panjang,
            'lebar' => $data->lebar,
            'kapasitas' => $data->kapasitas,
            'status' => $data->status,
            'user' => $data->user?->name,
            'seeding' => $seeding ? [
                'tanggal' => Carbon::parse($seeding->tanggal_penebaran)->format('d F Y'),
                'jenis' => $seeding->jenis_benih,
                'jumlah' => $seeding->jumlah_ikan,
                'estimasi_day' => $seeding?->estimated_days,
                'estimasi' => Carbon::parse($seeding->estimated_harvest_date)->format('d F Y'),
            ] : null,
        ];

        $this->dispatch('loadingHide', $this->previewKolam);
    }


    public function render()
    {
        return view('livewire.website.petazonasi');
    }
}
