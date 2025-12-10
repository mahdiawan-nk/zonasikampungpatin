<?php

namespace App\Livewire;

use Livewire\Component;

class Navbar extends Component
{

    public string $brandTitle = 'MyBrand';
    public string $brandLogo = '/apple-touch-icon.png';
    public function render()
    {
        return view('livewire.navbar');
    }
}
