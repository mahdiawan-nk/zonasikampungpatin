<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Masmerise\Toaster\Toaster;

class Create extends Component
{
    public $name, $email, $password, $role;

    public function store()
    {
        $validate = $this->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'role' => 'required',
                'password' => 'required',
            ],
            [
                'name.required' => 'Nama Harus di isi',
                'email.required' => 'Email Harus di isi',
                'email.unique' => 'Email Sudah Terdaftar',
                'role.required' => 'Role Harus di pilih',
                'password.required' => 'Password Harus di isi',
            ]
        );

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
        ]);

        Toaster::success('User created!');
        $this->reset(); 
        $this->dispatch('userCreated');
    }
    public function render()
    {
        return view('livewire.admin.user.create');
    }
}
