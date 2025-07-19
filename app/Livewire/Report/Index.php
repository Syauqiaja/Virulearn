<?php

namespace App\Livewire\Report;

use App\Models\Activity;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Laporan Siswa")]
class Index extends Component
{
    public $activities;
    public function mount(){
        $this->activities = Activity::all();
    }
    public function render()
    {
        return view('livewire.report.index');
    }
}
