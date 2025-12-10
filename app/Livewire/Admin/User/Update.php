<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Masmerise\Toaster\Toaster;

class Update extends Component
{
    public $userId;
    public $name, $email, $password, $role;
    public $editPassword = false;

    public function mount($userId)
    {
        $user = User::find($userId);
        $this->name = $user?->name;
        $this->email = $user?->email;
        $this->role = $user?->role;
    }

    public function update()
    {
        $validate = $this->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
            ],
            [
                'name.required' => 'Nama Harus di isi',
                'email.required' => 'Email Harus di isi',
                'email.unique' => 'Email Sudah Terdaftar',
                'role.required' => 'Role Harus di pilih',
            ]
        );

        if ($this->editPassword) {
            $validate = $this->validate(
                [
                    'password' => 'required',
                ],
                [
                    'password.required' => 'Password Harus di isi',
                ]
            );
        }

        $user = User::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->editPassword ? bcrypt($this->password) : $user->password,
            'role' => $this->role,
        ]);
        Toaster::success('User updated!');
        $this->dispatch('userCreated');
    }
    public function render()
    {
        return view('livewire.admin.user.update');
    }
}
