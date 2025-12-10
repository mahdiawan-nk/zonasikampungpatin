<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\User;
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
        $this->modal('create-user')->show();
    }

    public function openUpdate($id)
    {
        $this->selectedId = $id;
        $this->showUpdate = true;
        $this->modal('update-user')->show();

    }

    public function openDelete($id){
        $this->selectedId = $id;
        $this->modal('delete-user')->show();
    }

    public function deleteData(){
        $user = User::find($this->selectedId);
        $user->delete();
        Toaster::success('User deleted!'); 
        $this->closeModal();
    }
    #[On('userCreated'), On('userUpdated')]
    public function closeModal()
    {
        $this->showCreate = false;
        $this->showUpdate = false;
        $this->selectedId = null;
        $this->modal('create-user')->close();
        $this->modal('update-user')->close();
        $this->modal('delete-user')->close();

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
        $data = user::query()
            ->where('id','!=',auth()->user()->id)
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);
        return view('livewire.admin.user.index', compact('data'));
    }
}
