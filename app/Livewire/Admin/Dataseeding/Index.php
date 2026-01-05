<?php

namespace App\Livewire\Admin\Dataseeding;

use Livewire\Component;
use App\Models\DataSeeding;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;
use Symfony\Component\VarDumper\Cloner\Data;

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
        $this->modal('create-seeding')->show();
    }

    public function openUpdate($id)
    {
        $this->selectedId = $id;
        $this->showUpdate = true;
        $this->modal('update-seeding')->show();

    }

    public function openDelete($id)
    {
        $this->selectedId = $id;
        $this->modal('delete-seeding')->show();
    }

    public function deleteData()
    {
        $user = DataSeeding::find($this->selectedId);
        $user->delete();
        Toaster::success('Data deleted!');
        $this->closeModal();
    }

    #[On('seedingCreated'), On('seedingUpdated')]
    public function closeModal()
    {
        $this->showCreate = false;
        $this->showUpdate = false;
        $this->selectedId = null;
        $this->modal('create-seeding')->close();
        $this->modal('update-seeding')->close();
        $this->modal('delete-seeding')->close();

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
        // dd(DataSeeding::query()->with('kolam')->whereHas('kolam', fn($q) => $q->forUser())->get());
        $data = DataSeeding::query()
            ->with('kolam')
            ->whereHas('kolam', fn($q) => $q->forUser())
            ->paginate($this->perPage);
        return view('livewire.admin.dataseeding.index', compact('data'));
    }
}
