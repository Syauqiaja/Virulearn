<?php

namespace App\Livewire;

use App\Models\Activity;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title("Home")]
class Home extends Component
{
    public $activities;

    public function mount(){
        $this->activities = Activity::all();
    }
    public function render()
    {
        return view('livewire.home');
    }
}
