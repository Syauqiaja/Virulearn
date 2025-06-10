<?php

namespace App\Livewire\Activities;

use Livewire\Component;

class EditTests extends Component
{
    public int $id;
    public TestType $type;
    public int $totalSoal = 4;
    public function mount(TestType $type, int $id){
        $this->type = $type;
        $this->id = $id;
    }
    public function render()
    {
        return view('livewire.activities.edit-tests');
    }
    public function addQuestion(){
        $this->totalSoal++;
    }
}

enum TestType: string{
    case PRETEST = "pretest";
    case LATSOL = "latsol";
    case POSTTEST = "posttest";
}
