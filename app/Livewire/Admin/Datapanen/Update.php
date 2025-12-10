<?php

namespace App\Livewire\Admin\Datapanen;

use Livewire\Component;
use App\Models\DataSeeding;
use App\Models\DataEstimasiPanen as DataPanen;
use Masmerise\Toaster\Toaster;
class Update extends Component
{

    public $data_seeding_id, $estimated_days, $estimated_harvest_date, $notes;
    public $sgr = 0.02;
    public $initial_weight;
    public $target_weight = 500;
    public function mount($panenId)
    {
        $panen = DataPanen::find($panenId);
        $this->data_seeding_id = $panen->data_seeding_id;
        $this->estimated_days = $panen->estimated_days;
        $this->estimated_harvest_date = $panen->estimated_harvest_date;
        $this->notes = $panen->notes;
    }

    public function getSeedingsProperty()
    {
        return DataSeeding::all();
    }
    public function render()
    {
        return view('livewire.admin.datapanen.update');
    }
}
