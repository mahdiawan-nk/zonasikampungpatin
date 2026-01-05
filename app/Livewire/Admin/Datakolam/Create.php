<?php

namespace App\Livewire\Admin\Datakolam;

use Livewire\Component;
use Masmerise\Toaster\Toaster;
use App\Models\DataKolam;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\MapLayer;
use Livewire\Attributes\Layout;
class Create extends Component
{
    public $nama_kolam, $panjang, $lebar, $kedalaman, $status, $user_id, $kapasitas;
    public $feature_id = null;
    public $polygon = [];
    public $cordinate = [];
    public $showModal = false;
    public $selectedKolam = null;
    public $dataUser = [];
    public $savedPolygons = [];
    public $offlineLayers = [];
    public bool $isReadySubmit = false;

    public $ownerId = null;
    protected $listeners = [
        'polygonClicked' => 'openModalFromMap'
    ];
    public function mount()
    {
        $this->dataUser = User::where('role', 'Pemilik Kolam')->get();
        $this->ownerId = auth()->user()->isAdmin() ? null : auth()->user()->id;
        $this->user_id = $this->ownerId;
        $this->loadSavedPolygons();
        $this->loadOfflineLayers();
    }

    // public function loadOfflineLayers()
    // {
    //     // Ambil data kolam dan index dengan feature_id
    //     $kolams = DataKolam::query()
    //         ->forUser()
    //         ->select('feature_id', 'nama_kolam')->get()
    //         ->keyBy('feature_id');

    //     $kolamsId = $kolams->keys()->toArray(); // lebih efisien

    //     $this->offlineLayers = MapLayer::with('features')->get()->map(function ($layer) use ($kolams, $kolamsId) {
    //         return [
    //             'id' => $layer->layer_id,
    //             'type' => $layer->layer_type,
    //             'paint' => $layer->paint,
    //             'source_layer' => $layer->source_layer,
    //             'data' => [
    //                 'type' => 'FeatureCollection',
    //                 'features' => $layer->features->map(function ($f) use ($kolams, $kolamsId) {
    //                     return [
    //                         'type' => 'Feature',
    //                         'id' => $f->feature_id,
    //                         'geometry' => [
    //                             'type' => $f->geometry_type,
    //                             'coordinates' => json_decode($f->coordinates, true),
    //                         ],
    //                         'properties' => [
    //                             ...json_decode($f->properties, true),
    //                             'is_kolam' => in_array($f->feature_id, $kolamsId) ? 1 : 0,
    //                             'name' => $kolams[$f->feature_id]->nama_kolam ?? null,
    //                         ],
    //                     ];
    //                 })
    //             ]
    //         ];
    //     })->toArray();
    // }

    public function loadOfflineLayers()
    {
        $user = auth()->user();
        $isAdmin = $user->isAdmin();

        // Semua kolam (untuk mapping ownership)
        $allKolams = DataKolam::query()
            ->select('feature_id', 'nama_kolam', 'user_id')
            ->get()
            ->keyBy('feature_id');

        $this->offlineLayers = MapLayer::with('features')->get()
            ->map(function ($layer) use ($allKolams, $user, $isAdmin) {

                $features = $layer->features
                    ->filter(function ($f) use ($allKolams, $user, $isAdmin) {

                        if ($isAdmin) {
                            return true;
                        }

                        if (!$allKolams->has($f->feature_id)) {
                            // kolam belum terdaftar → boleh tampil
                            return true;
                        }

                        // kolam terdaftar → hanya milik user sendiri
                        return $allKolams[$f->feature_id]->user_id === $user->id;
                    })
                    ->map(function ($f) use ($allKolams, $user) {

                        $kolam = $allKolams->get($f->feature_id);

                        return [
                            'type' => 'Feature',
                            'id' => $f->feature_id,
                            'geometry' => [
                                'type' => $f->geometry_type,
                                'coordinates' => json_decode($f->coordinates, true),
                            ],
                            'properties' => [
                                ...json_decode($f->properties, true),

                                // UI FLAG
                                'owned_by_me' => $kolam && $kolam->user_id === $user->id,
                                'is_registered' => (bool) $kolam,
                                'selected' => false,
                                'name' => $kolam?->nama_kolam,
                            ],
                        ];
                    });

                return [
                    'id' => $layer->layer_id,
                    'type' => $layer->layer_type,
                    'paint' => $layer->paint,
                    'source_layer' => $layer->source_layer,
                    'data' => [
                        'type' => 'FeatureCollection',
                        'features' => $features->values(),
                    ],
                ];
            })
            ->values()
            ->toArray();
    }


    public function loadSavedPolygons()
    {
        $this->savedPolygons = DataKolam::pluck('feature_id')
            ->filter() // buang null
            ->values()
            ->toArray();
    }
    #[On('dataMapSet')]
    public function setUpDataMaps($feature_id, $polygon, $clickpoint)
    {
        $this->feature_id = $feature_id;
        $this->polygon = json_encode($polygon);
        $this->cordinate = json_encode($clickpoint);
        $this->isReadySubmit = true;
        $this->dispatch('polygon-selected');
        Toaster::info('Data polygon siap untuk disimpan.');
    }
    public function store()
    {
        if ($this->feature_id === null || $this->polygon === null || $this->cordinate === null) {
            Toaster::error('Please select a polygon from the map!');
            return;
        }
        $validate = $this->validate([
            'nama_kolam' => 'required',
            'panjang' => 'required',
            'lebar' => 'required',
            'kedalaman' => 'required',
            'kapasitas' => 'required',
            'status' => 'required',
            'user_id' => 'required',
        ]);
        $kolam = new DataKolam();
        $kolam->nama_kolam = $this->nama_kolam;
        $kolam->panjang = $this->panjang;
        $kolam->lebar = $this->lebar;
        $kolam->kedalaman = $this->kedalaman;
        $kolam->kapasitas = $this->kapasitas;
        $kolam->user_id = $this->user_id;
        $kolam->status = $this->status;
        $kolam->feature_id = $this->feature_id;
        $kolam->polygon = json_encode($this->polygon);
        $kolam->cordinate = json_encode($this->cordinate);
        $kolam->save();
        Toaster::success('Kolam created!');
        $this->resetForm();
        $this->loadSavedPolygons();
        $this->loadOfflineLayers();
        $this->dispatch('offline-layers-updated', layers: $this->offlineLayers);
        $this->dispatch('successCreated');
        return $this->redirectRoute('kolam.index', navigate: true);

    }

    public function resetForm()
    {
        $this->reset();
        $this->feature_id = null;
        $this->polygon = [];
        $this->cordinate = [];
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.admin.datakolam.create');
    }
}
