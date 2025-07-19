<?php

namespace App\Livewire\Report;

use App\Models\Activity;
use Livewire\Component;

class Detail extends Component
{
    public Activity $activity;
    public function mount($activity){
        $this->activity = $activity;
    }
    public function render()
    {
        return view('livewire.report.detail');
    }

    
}
