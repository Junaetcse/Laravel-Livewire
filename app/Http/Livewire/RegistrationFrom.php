<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RegistrationFrom extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.registration-from');
    }
}
