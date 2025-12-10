<?php

namespace App\Livewire\Admin\Datapanen;

use Livewire\Component;
use App\Models\DataSeeding;
use App\Models\DataEstimasiPanen as DataPanen;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;
class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $perPage = 10;
    public $showCreate = false;
    public $showUpdate = false;
    public $selectedId;

    public function openCreate()
    {
        $this->selectedId = null;
        $this->showCreate = true;
        $this->modal('create-panen')->show();
    }

    public function openUpdate($id)
    {
        $this->selectedId = $id;
        $this->showUpdate = true;
        $this->modal('update-panen')->show();

    }

    public function openDelete($id)
    {
        $this->selectedId = $id;
        $this->modal('delete-panen')->show();
    }

    public function deleteData()
    {
        $user = DataSeeding::find($this->selectedId);
        $user->delete();
        Toaster::success('Data deleted!');
        $this->closeModal();
    }

    #[On('panenCreated'), On('panenUpdated')]
    public function closeModal()
    {
        $this->showCreate = false;
        $this->showUpdate = false;
        $this->selectedId = null;
        $this->modal('create-panen')->close();
        $this->modal('update-panen')->close();
        $this->modal('delete-panen')->close();

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage(); // reset ke halaman 1 saat ganti perPage

    }
    public function render()
    {
        $data = DataPanen::query()
            ->whereHas('dataSeeding', function ($query) {
                $query->where('jenis_benih', 'like', '%' . $this->search . '%');
            })
            ->orWhere('sgr', 'like', '%' . $this->search . '%')
            ->orWhere('target_weight', 'like', '%' . $this->search . '%')
            ->orWhere('estimated_days', 'like', '%' . $this->search . '%')
            ->orWhere('estimated_harvest_date', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);
        return view('livewire.admin.datapanen.index', compact('data'));
    }
}
