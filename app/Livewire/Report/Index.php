<?php

namespace App\Livewire\Report;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Laporan Siswa")]
class Index extends Component
{
    public function render()
    {
        return view('livewire.report.index');
    }
}
