<?php

namespace App\Livewire\Activities;

use App\Models\Activity;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Aktitivas")]
class Index extends Component
{
    public $activities;
    #[On("activityCreated")]
    public function load(){
        $this->activities = Activity::all();
    }

    public function render()
    {
        $this->activities = Activity::all();
        return view('livewire.activities.index');
    }
}
