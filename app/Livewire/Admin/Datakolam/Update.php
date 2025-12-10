<?php

namespace App\Livewire\Admin\Datakolam;

use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Masmerise\Toaster\Toastable;
use App\Models\DataKolam;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\MapLayer;

class Update extends Component
{
    use Toastable;
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
    public $selectIdKolam=[];

    public function mount($id)
    {

        $this->selectIdKolam = $id;
        $this->loadCurrentData();
        $this->dataUser = User::where('role', 'Pemilik Kolam')->get();
        $this->loadOfflineLayers();
    }

    public function loadCurrentData(){
        $this->selectedKolam = DataKolam::find($this->selectIdKolam);
        $this->nama_kolam = $this->selectedKolam->nama_kolam;
        $this->panjang = $this->selectedKolam->panjang;
        $this->lebar = $this->selectedKolam->lebar;
        $this->kedalaman = $this->selectedKolam->kedalaman;
        $this->status = $this->selectedKolam->status;
        $this->user_id = $this->selectedKolam->user_id;
        $this->kapasitas = $this->selectedKolam->kapasitas;
        $this->feature_id = $this->selectedKolam->feature_id;
        $this->polygon = json_encode($this->selectedKolam->polygon);
        $this->cordinate = json_encode($this->selectedKolam->cordinate);
        $this->isReadySubmit = true;
    }

    public function loadOfflineLayers()
    {
        // Ambil semua feature_id kolam yang sudah disimpan
        $kolams = DataKolam::select('feature_id','nama_kolam')->get()
            ->keyBy('feature_id');

        $kolamsId = $kolams->keys()->toArray();
        $currentFeatureId = optional($this->selectedKolam)->feature_id;

        $this->offlineLayers = MapLayer::with('features')->get()->map(function ($layer) use ($kolamsId, $currentFeatureId, $kolams) {
            return [
                'id' => $layer->layer_id,
                'type' => $layer->layer_type,
                'source_layer' => $layer->source_layer,

                // Default paint, akan ditimpa oleh paint per-feature di frontend
                'paint' => $layer->paint,

                'data' => [
                    'type' => 'FeatureCollection',
                    'features' => $layer->features->map(function ($f) use ($kolamsId, $currentFeatureId, $kolams) {

                        // Tentukan warna berdasarkan kondisi
                        $color = '#3b82f6'; // Biru (default)
                        if ($f->feature_id === $currentFeatureId) {
                            $color = '#22c55e'; // Hijau
                        } elseif (in_array($f->feature_id, $kolamsId)) {
                            $color = '#ef4444'; // Merah
                        }

                        return [
                            'type' => 'Feature',
                            'id' => $f->feature_id,
                            'geometry' => [
                                'type' => $f->geometry_type,
                                'coordinates' => json_decode($f->coordinates, true),
                            ],
                            'properties' => [
                                ...json_decode($f->properties, true),
                                'is_kolam' => in_array($f->feature_id, $kolamsId) ? 1 : 0,
                                'color' => $color, // kirim warna ke Alpine
                                'name' => $kolams[$f->feature_id]->nama_kolam ?? null,
                            ],
                        ];
                    })
                ]
            ];
        })->toArray();
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
        $kolam = DataKolam::find($this->selectIdKolam);
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
        Toaster::success('Kolam updated!');
        $this->resetForm();
        $this->mount($kolam->id);
        $this->dispatch('offline-layers-updated', layers: $this->offlineLayers);
        $this->dispatch('successCreated');
        // return $this->redirect(route('kolam.index'),navigate:true);
        return $this->redirectRoute('kolam.index', navigate: true);

    }

    public function resetForm()
    {
        $this->reset();
        $this->feature_id = null;
        $this->polygon = [];
        $this->cordinate = [];
    }
    public function render()
    {
        return view('livewire.admin.datakolam.update');
    }
}
