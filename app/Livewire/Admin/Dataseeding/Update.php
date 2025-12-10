<?php

namespace App\Livewire\Admin\Dataseeding;

use Livewire\Component;
use App\Models\DataKolam;
use App\Models\DataSeeding;
use Masmerise\Toaster\Toaster;
class Update extends Component
{

    public $tanggal_penebaran, $data_kolam_id, $jenis_benih, $jumlah_ikan, $berat_rata_rata, $keterangan;
    public $seedingId;
    public function mount($seedingId)
    {
        $this->seedingId = $seedingId;
        $seeding = DataSeeding::find($this->seedingId);
        $this->tanggal_penebaran = $seeding?->tanggal_penebaran;
        $this->data_kolam_id = $seeding?->data_kolam_id;
        $this->jenis_benih = $seeding?->jenis_benih;
        $this->jumlah_ikan = $seeding?->jumlah_ikan;
        $this->berat_rata_rata = $seeding?->berat_rata_rata;
        $this->keterangan = $seeding?->keterangan;

    }
    public function getKolamsProperty()
    {
        return DataKolam::all();
    }

    public function update()
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

        $seeding = DataSeeding::find($this->seedingId);
        $seeding->update([
            'tanggal_penebaran' => $this->tanggal_penebaran,
            'data_kolam_id' => $this->data_kolam_id,
            'jenis_benih' => $this->jenis_benih,
            'jumlah_ikan' => $this->jumlah_ikan,
            'berat_rata_rata' => $this->berat_rata_rata,
            'keterangan' => $this->keterangan,
        ]);

        Toaster::success('Data Seeding updated!');
        $this->dispatch('seedingUpdated');
    }
    public function render()
    {
        return view('livewire.admin.dataseeding.update');
    }
}
