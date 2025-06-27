<?php

namespace App\Livewire\User;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Laporan Siswa")]
class Index extends Component
{
    public function render()
    {
        return view('livewire.user.index');
    }
}
