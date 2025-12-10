<?php

namespace App\Livewire\Admin\Datakolam;

use Livewire\Component;
use App\Models\DataKolam;
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
        $this->reset('selectedId');
        $this->showCreate = true;
        $this->modal('create-kolam')->show();
    }

    public function openUpdate($id)
    {
        $this->selectedId = $id;
        $this->showUpdate = true;
        $this->modal('update-kolam')->show();

    }

    public function openDelete($id)
    {
        $this->selectedId = $id;
        $this->modal('delete-kolam')->show();
    }

    public function deleteData()
    {
        $kolam = DataKolam::find($this->selectedId);
        $kolam->delete();
        Toaster::success('Kolam deleted!');
        $this->closeModal();
    }
    #[On('kolamCreated'), On('kolamUpdated')]
    public function closeModal()
    {
        $this->showCreate = false;
        $this->showUpdate = false;
        $this->selectedId = null;
        $this->modal('create-kolam')->close();
        $this->modal('update-kolam')->close();
        $this->modal('delete-kolam')->close();

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
        $data = DataKolam::query()
            ->with('user')
            ->when($this->search, function ($q) {
                $q->where('nama_kolam', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);
        return view('livewire.admin.datakolam.index',compact('data'));
    }
}
