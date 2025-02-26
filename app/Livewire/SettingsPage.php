<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class SettingsPage extends Component
{
    #[Title('Settings')]
    public function render()
    {
        return view('livewire.settings-page');
    }
}
