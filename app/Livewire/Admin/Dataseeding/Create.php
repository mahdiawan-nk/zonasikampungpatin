<?php

namespace App\Livewire\Admin\Dataseeding;

use Livewire\Component;
use App\Models\DataKolam;
use App\Models\DataSeeding;
use Masmerise\Toaster\Toaster;
class Create extends Component
{
    public $tanggal_penebaran, $data_kolam_id, $jenis_benih, $jumlah_ikan, $berat_rata_rata, $keterangan;

    public function mount()
    {
        $this->tanggal_penebaran = '';
        $this->data_kolam_id = '';
        $this->jenis_benih = '';
        $this->jumlah_ikan = '';
        $this->berat_rata_rata = '';
        $this->keterangan = '';
    }

    public function getKolamsProperty()
    {
        return DataKolam::forUser()->get();
    }
    public function store()
    {
        $validate = $this->validate(
            [
                'tanggal_penebaran' => 'required|date',
                'data_kolam_id' => 'required|exists:data_kolams,id',
                'jenis_benih' => 'required|string',
                'jumlah_ikan' => 'required|integer',
                'berat_rata_rata' => 'required|numeric',
                'keterangan' => 'nullable|string',
            ],
            [
                'tanggal_penebaran.required' => 'Tanggal Penebaran Harus di isi',
                'data_kolam_id.required' => 'Kolam Harus di pilih',
                'data_kolam_id.exists' => 'Kolam Tidak Valid',
                'jenis_benih.required' => 'Jenis Benih Harus di isi',
                'jumlah_ikan.required' => 'Jumlah Ikan Harus di isi',
                'berat_rata_rata.required' => 'Berat Rata Rata Harus di isi',
            ]
        );

        $seeding = DataSeeding::create([
            'tanggal_penebaran' => $this->tanggal_penebaran,
            'data_kolam_id' => $this->data_kolam_id,
            'jenis_benih' => $this->jenis_benih,
            'jumlah_ikan' => $this->jumlah_ikan,
            'berat_rata_rata' => $this->berat_rata_rata,
            'keterangan' => $this->keterangan,
        ]);

        Toaster::success('Data Seeding created!');
        $this->reset();
        $this->dispatch('seedingCreated');
    }
    public function render()
    {
        return view('livewire.admin.dataseeding.create');
    }
}
