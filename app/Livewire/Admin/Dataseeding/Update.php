<?php

namespace App\Livewire\Admin\Dataseeding;

use Livewire\Component;
use App\Models\DataKolam;
use App\Models\DataSeeding;
use Masmerise\Toaster\Toaster;
use Carbon\Carbon;
class Update extends Component
{

    public $tanggal_penebaran, $data_kolam_id, $jenis_benih, $jumlah_ikan, $berat_rata_rata, $keterangan, $estimated_days, $estimated_harvest_date;
    public $seedingId;
    public function mount($seedingId)
    {
        $this->seedingId = $seedingId;
        $seeding = DataSeeding::find($this->seedingId);
        $this->tanggal_penebaran = Carbon::parse($seeding?->tanggal_penebaran)->format('Y-m-d');
        $this->data_kolam_id = $seeding?->data_kolam_id;
        $this->jenis_benih = $seeding?->jenis_benih;
        $this->jumlah_ikan = $seeding?->jumlah_ikan;
        $this->berat_rata_rata = $seeding?->berat_rata_rata;
        $this->keterangan = $seeding?->keterangan;
        $this->estimated_days = $seeding?->estimasi_days ?? 0;
        $this->estimated_harvest_date = Carbon::parse($seeding?->estimated_harvest_date)->format('Y-m-d');
    }
    public function getKolamsProperty()
    {
        return DataKolam::all();
    }

    public function updatedEstimatedDays()
    {
        $this->estimated_harvest_date = Carbon::parse($this->tanggal_penebaran)->addDays((int) $this->estimated_days)->format('Y-m-d');
        // dump($this->estimated_harvest_date);
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
                'estimated_days' => 'required|integer',
                'estimated_harvest_date' => 'nullable|date',
                'keterangan' => 'nullable|string',
            ],
            [
                'tanggal_penebaran.required' => 'Tanggal Penebaran Harus di isi',
                'data_kolam_id.required' => 'Kolam Harus di pilih',
                'data_kolam_id.exists' => 'Kolam Tidak Valid',
                'jenis_benih.required' => 'Jenis Benih Harus di isi',
                'jumlah_ikan.required' => 'Jumlah Ikan Harus di isi',
                'berat_rata_rata.required' => 'Berat Rata Rata Harus di isi',
                'estimated_days.required' => 'Estimasi Days Harus di isi',
                'estimated_harvest_date.required' => 'Estimasi Harvest Date Harus di isi',

            ]
        );

        $seeding = DataSeeding::find($this->seedingId);
        $seeding->update([
            'tanggal_penebaran' => $this->tanggal_penebaran,
            'data_kolam_id' => $this->data_kolam_id,
            'jenis_benih' => $this->jenis_benih,
            'jumlah_ikan' => $this->jumlah_ikan,
            'berat_rata_rata' => $this->berat_rata_rata,
            'estimated_days' => $this->estimated_days,
            'estimated_harvest_date' => $this->estimated_harvest_date,
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
