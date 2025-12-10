<?php

namespace App\Livewire\Admin\Datapanen;

use Livewire\Component;
use App\Models\DataSeeding;
use App\Models\DataEstimasiPanen as DataPanen;
use Masmerise\Toaster\Toaster;
use Carbon\Carbon;
class Create extends Component
{
    public $data_seeding_id, $estimated_days, $estimated_harvest_date, $notes;
    public $tanggal_tebar;
    public $jumlah_ikan;
    public $sgr = 0.02;
    public $initial_weight;
    public $target_weight = 500;

    public function mount()
    {
        $this->data_seeding_id = '';
        $this->estimated_days = '';
        $this->estimated_harvest_date = '';
        $this->notes = '';
    }

    public function getSeedingsProperty()
    {
        return DataSeeding::all();
    }

    public function setUpDdata()
    {
        if ($this->data_seeding_id) {
            $seeding = DataSeeding::find($this->data_seeding_id);
            $this->initial_weight = $seeding->berat_rata_rata;
            $this->tanggal_tebar = $seeding->tanggal_penebaran;
            $this->jumlah_ikan = $seeding->jumlah_ikan;
        }
    }

    public function updating($property, $value)
    {
        // $this->calculate();
        // dump($property, $value);
        if ($property == 'data_seeding_id') {
            $this->data_seeding_id = $value;
            $this->setUpDdata();
            $this->calculate();

        }

        if ($property == 'sgr' || $property == 'target_weight') {
            if ($property == 'sgr') {
                $this->sgr = $value;

            }
            if ($property == 'target_weight') {
                $this->target_weight = $value;

            }
            $this->calculate();

        }

    }
    public function calculate()
    {
        if (!$this->initial_weight || !$this->target_weight || !$this->sgr) {
            $this->estimated_days = null;
            $this->estimated_harvest_date = null;
            return;
        }


        $Wi = $this->initial_weight / 1000;
        $Wt = $this->target_weight / 1000;
        // dump($this->initial_weight, $this->target_weight, $Wi, $Wt, $this->sgr);


        $t = log($Wt / $Wi) / $this->sgr;
        $days = (int) ceil($t);


        $this->estimated_days = $days;
        $this->estimated_harvest_date = Carbon::parse($this->tanggal_tebar)->addDays($days)->toDateString();
    }
    public function store()
    {
        $validate = $this->validate(
            [
                'data_seeding_id' => 'required|exists:data_seedings,id',
                'sgr' => 'required|numeric',
                'target_weight' => 'required|numeric',
                'estimated_days' => 'required|integer',
                'estimated_harvest_date' => 'required|date',
                'notes' => 'nullable|string',
            ],
            [
                'data_seeding_id.required' => 'Data Seeding Harus di pilih',
                'data_seeding_id.exists' => 'Data Seeding Tidak Valid',
                'sgr.required' => 'SGR Harus di isi',
                'target_weight.required' => 'Target Weight Harus di isi',
                'estimated_days.required' => 'Estimated Days Harus di isi',
                'estimated_harvest_date.required' => 'Estimated Harvest Date Harus di isi',
            ]
        );
        DataPanen::create([
            'data_seeding_id' => $this->data_seeding_id,
            'sgr' => $this->sgr,
            'target_weight' => $this->target_weight,
            'estimated_days' => $this->estimated_days,
            'estimated_harvest_date' => $this->estimated_harvest_date,
            'notes' => $this->notes,
        ]);
        Toaster::success('Data saved!');
        $this->reset(); 
        $this->dispatch('panenCreated');
    }
    public function render()
    {
        return view('livewire.admin.datapanen.create');
    }
}
